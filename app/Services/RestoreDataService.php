<?php

namespace App\Services;

use Exception;
use Throwable;
use App\Data\ExpenseGainDto;
use App\Models\Bank;
use App\Models\BankTemplate;
use App\Models\Budget;
use App\Models\BudgetTemplate;
use App\Models\ExpenseType;
use App\Models\User;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RestoreDataService
{
    private ConnectionInterface $db;

    public function __construct()
    {

        $this->db = DB::build([
            'driver' => config('database.connections.mysql.driver'),
            'database' => config('database.connections.mysql.backup_database'),
            'username' => config('database.connections.mysql.username'),
            'password' => config('database.connections.mysql.password'),
        ]);
    }

    /**
     * @return void
     * @throws Throwable
     */
    public function restore(): void
    {
        try {
            DB::beginTransaction();

            $users = $this->restoreUsers();
            $this->restoreBudgetTemplates($users);
            $this->restoreBudgets($users);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param array<string, int> $budget
     * @param bool $template
     * @return void
     */
    private function restoreBanks(array $budget, bool $isTemplate = false): void
    {
        // budget columns: name, amount, bank_type_id, budget_id, bank_template_id
        // template columns: name, amount, bank_type_id, bank_template_id
        $model = BankTemplate::class;
        $columnName = 'budget_template_id';
        $tableName = 'bank_templates';

        if (! $isTemplate) {
            $model = Bank::class;
            $columnName = 'budget_id';
            $tableName = 'banks';
        }

        $this->db
            ->table($tableName)
            ->where($columnName, $budget['old_id'])
            ->get()
            ->each(function ($bank) use ($budget, $model, $columnName) {
                $type = $this->db
                    ->table('bank_types')
                    ->where('id', $bank->bank_type_id)
                    ->first();

                $expenseType = ExpenseType::query()
                    ->where('name', $type->name)
                    ->orWhere('slug', $type->slug)
                    ->first();

                $model::create([
                    $columnName => $budget['new_id'],
                    'data' => new ExpenseGainDto(
                        name: $bank->name,
                        amount: $bank->amount,
                    ),
                    'expense_type_id' => $expenseType->id,
                    'created_at' => $bank->created_at,
                    'updated_at' => $bank->updated_at,
                ]);
            });
    }

    private function restoreBudgets(Collection $users): void
    {
        $users->each(function ($user) {
            $this->db
                ->table('budgets')
                ->where('user_id', $user['old_id'])
                ->get()
                ->each(function ($budget) use ($user) {
                    $b = Budget::create([
                        'user_id' => $user['new_id'],
                        'name' => $budget->name,
                        'budget_cycle' => $budget->budget_cycle,
                        'created_at' => $budget->created_at,
                        'updated_at' => $budget->updated_at,
                    ]);

                    // @todo restore all the budgets here
                    $bud = ['old_id' => $budget->id, 'new_id' => $b->id];
                    $this->restoreBanks($bud);
                });
        });
    }

    private function restoreBudgetTemplates(Collection $users): void
    {
        $users->each(function ($user) {
            $this->db
                ->table('budget_templates')
                ->where('user_id', $user['old_id'])
                ->get()
                ->each(function ($template) use ($user) {
                    $bt = BudgetTemplate::create([
                        'user_id' => $user['new_id'],
                        'created_at' => $template->created_at,
                        'updated_at' => $template->updated_at,
                    ]);

                    // @todo restore all the templates here
                    $t = ['old_id' => $template->id, 'new_id' => $bt->id];
                    $this->restoreBanks($t, true);
                });
        });
    }

    private function restoreUsers(): Collection
    {
        return $this->db
            ->table('users')
            ->join('user_profile', 'users.id', '=', 'user_profile.user_id')
            ->get()
            ->map(function ($user) {
                $u = User::create([
                    'email' => $user->email,
                    'password' => $user->password,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                    'email_verified_at' => $user->email_verified_at,
                    'name' => $user->first_name . ' ' . $user->last_name,
                ]);

                return ['old_id' => $user->id, 'new_id' => $u->id];
            });
    }
}
