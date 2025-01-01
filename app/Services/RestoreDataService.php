<?php

namespace App\Services;

use App\Data\CreditCardDto;
use App\Data\ExpenseSpendDto;
use App\Data\IncomeDto;
use App\Data\UserVehicleDto;
use App\Data\VehicleDto;
use App\Models\Childcare;
use App\Models\ChildcareTemplate;
use App\Models\CreditCard;
use App\Models\CreditCardTemplate;
use App\Models\Education;
use App\Models\EducationTemplate;
use App\Models\Entertainment;
use App\Models\EntertainmentTemplate;
use App\Models\Food;
use App\Models\FoodTemplate;
use App\Models\Gift;
use App\Models\GiftTemplate;
use App\Models\Housing;
use App\Models\HousingTemplate;
use App\Models\Income;
use App\Models\IncomeTemplate;
use App\Models\Investment;
use App\Models\InvestmentTemplate;
use App\Models\Loan;
use App\Models\LoanTemplate;
use App\Models\Medical;
use App\Models\MedicalTemplate;
use App\Models\Miscellaneous;
use App\Models\MiscellaneousTemplate;
use App\Models\Personal;
use App\Models\PersonalTemplate;
use App\Models\Shopping;
use App\Models\ShoppingTemplate;
use App\Models\Subscription;
use App\Models\SubscriptionTemplate;
use App\Models\Tax;
use App\Models\TaxTemplate;
use App\Models\Travel;
use App\Models\TravelTemplate;
use App\Models\UserVehicle;
use App\Models\Utility;
use App\Models\UtilityTemplate;
use App\Models\Vehicle;
use App\Models\VehicleTemplate;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
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
use stdClass;

readonly class RestoreDataService
{
    private ConnectionInterface $db;
    private CommonExpenseService $commonExpenseService;

    public function __construct(
        ConnectionInterface $db,
        CommonExpenseService $commonExpenseService,
    )
    {
        $this->db = $db;
        $this->commonExpenseService = $commonExpenseService;
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
     * @param stdClass $data
     * @param array{new_id: string, old_id: string, vehicles: Collection} $user
     * @return array
     */
    private function getUserVehicle(stdClass $data, array $user): array
    {
        if (empty($data->user_vehicle_id) || empty($user)) {
            return [];
        }

        $userVehicle = $user['vehicles']
            ->filter(fn ($vehicle) => $data->user_vehicle_id === $vehicle['old_id'])
            ->first();

        if (empty($userVehicle)) {
            return [];
        }

        return ['user_vehicle_id' => $userVehicle['new_id']];
    }

    /**
     * @param array{old_id: int, new_id: int} $budget
     * @param bool $isTemplate
     * @return void
     */
    private function restoreBanks(array $budget, bool $isTemplate = false): void
    {
        $models = ['template' => BankTemplate::class, 'budget' => Bank::class];
        $table = 'banks';

        $this->restoreExpense($models, $table, $budget, $isTemplate, function ($data) {
            return new ExpenseGainDto(
                name: $data->name,
                amount: $data->amount,
            );
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

                    $bud = ['old_id' => $budget->id, 'new_id' => $b->id];

                    $this->restoreBanks($bud);
                    $this->restoreCreditCards($bud);
                    $this->restoreCommonExpenses($bud);
                    $this->restoreIncomes($bud);
                    $this->restoreInvestments($bud);
                    $this->restoreVehicles($bud, $user);
                    $this->saveAggregations($bud);
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

                    $t = ['old_id' => $template->id, 'new_id' => $bt->id];

                    $this->restoreBanks($t, true);
                    $this->restoreCreditCards($t, true);
                    $this->restoreCommonExpenses($t, true);
                    $this->restoreIncomes($t, true);
                    $this->restoreInvestments($t, true);
                    $this->restoreVehicles($t, $user, true);
                });
        });
    }

    /**
     * @param array{old_id: int, new_id: int} $budget
     * @param bool $isTemplate
     * @return void
     */
    private function restoreCreditCards(array $budget, bool $isTemplate = false): void
    {
        $models = ['template' => CreditCardTemplate::class, 'budget' => CreditCard::class];
        $table = 'credit_cards';

        $this->restoreExpense($models, $table, $budget, $isTemplate, function ($data) {
            return new CreditCardDto(
                name: $data->name,
                amount: $data->amount,
                due_date: $data->due_date,
                apr: $data->apr,
                balance: (float)$data->balance,
                exp_month: (int)$data->exp_month,
                exp_year: (int)$data->exp_year,
                last_4: (int)$data->last_4,
                limit: (float)$data->limit,
                paid_date: ! empty($data->paid_date) ? Carbon::parse($data->paid_date) : null,
                confirmation: $data->confirmation ?? null,
                notes: $data->notes ?? null,
            );
        });
    }

    /**
     * @param array{old_id: int, new_id: int} $budget
     * @param bool $isTemplate
     * @return void
     */
    private function restoreCommonExpenses(array $budget, bool $isTemplate = false): void
    {
        $expenses = [
            [
                'budget' => Childcare::class,
                'template' => ChildcareTemplate::class,
                'table' => 'childcare',
            ],
            [
                'budget' => Education::class,
                'template' => EducationTemplate::class,
                'table' => 'education',
            ],
            [
                'budget' => Entertainment::class,
                'template' => EntertainmentTemplate::class,
                'table' => 'entertainment',
            ],
            [
                'budget' => Food::class,
                'template' => FoodTemplate::class,
                'table' => 'food',
            ],
            [
                'budget' => Gift::class,
                'template' => GiftTemplate::class,
                'table' => 'gift',
            ],
            [
                'budget' => Housing::class,
                'template' => HousingTemplate::class,
                'table' => 'housing',
            ],
            [
                'budget' => Loan::class,
                'template' => LoanTemplate::class,
                'table' => 'loans',
            ],
            [
                'budget' => Medical::class,
                'template' => MedicalTemplate::class,
                'table' => 'medical',
            ],
            [
                'budget' => Miscellaneous::class,
                'template' => MiscellaneousTemplate::class,
                'table' => 'miscellaneous',
            ],
            [
                'budget' => Personal::class,
                'template' => PersonalTemplate::class,
                'table' => 'personal',
            ],
            [
                'budget' => Shopping::class,
                'template' => ShoppingTemplate::class,
                'table' => 'shopping',
            ],
            [
                'budget' => Subscription::class,
                'template' => SubscriptionTemplate::class,
                'table' => 'subscriptions',
            ],
            [
                'budget' => Tax::class,
                'template' => TaxTemplate::class,
                'table' => 'tax',
            ],
            [
                'budget' => Travel::class,
                'template' => TravelTemplate::class,
                'table' => 'travel',
            ],
            [
                'budget' => Utility::class,
                'template' => UtilityTemplate::class,
                'table' => 'utilities',
            ],
        ];

        foreach ($expenses as $expense) {
            $models = ['template' => $expense['template'], 'budget' => $expense['budget']];
            $table = $expense['table'];

            $this->restoreExpense($models, $table, $budget, $isTemplate, function ($data) {
                return new ExpenseSpendDto(
                    name: $data->name,
                    amount: $data->amount,
                    due_date: $data->due_date ?? null,
                    confirmation: $data->confirmation ?? null,
                    paid_date: ! empty($data->paid_date) ? Carbon::parse($data->paid_date) : null,
                    notes: $data->notes ?? null,
                );
            });
        }
    }

    /**
     * @return Collection<string, array<string, int>>
     */
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

                $u = ['old_id' => $user->user_id, 'new_id' => $u->id];

                $u['vehicles'] = $this->restoreUserVehicles($u);

                return $u;
            });
    }

    /**
     * @param array{template: string, budget: string} $models
     * @param string $table
     * @param array{old_id: int, new_id: int} $budget
     * @param bool $isTemplate
     * @param callable $callback
     * @param array{old_id: int, new_id: int, vehicles: Collection} $user
     * @return void
     */
    private function restoreExpense(array $models, string $table, array $budget, bool $isTemplate, callable $callback, array $user = []): void
    {
        $singularName = ! in_array($table, ['miscellaneous']) ? Str::singular($table) : $table;
        $model = $models['template'];
        $columnName = 'budget_template_id';
        $tableName = $singularName . '_templates';

        if (! $isTemplate) {
            $model = $models['budget'];
            $columnName = 'budget_id';
            $tableName = $table;
        }

        $this->db
            ->table($tableName)
            ->where($columnName, $budget['old_id'])
            ->get()
            ->each(function ($data) use ($budget, $model, $singularName, $columnName, $callback, $user) {
                $expenseType = null;

                if (! empty($data->{$singularName . '_type_id'})) {
                    /** @var object{name: string, slug: string} $type */
                    $type = $this->db
                        ->table($singularName . '_types')
                        ->where('id', $data->{$singularName . '_type_id'})
                        ->firstOrFail();

                    $expenseType = ExpenseType::query()
                        ->where('name', $type->name)
                        ->orWhere('slug', $type->slug)
                        ->first();
                }

                if (empty($expenseType)) {
                    $expenseType = ExpenseType::query()
                        ->where('slug', 'empty-type')
                        ->firstOrFail();
                }

                $options = $this->getUserVehicle($data, $user);

                $model::create([
                    $columnName => $budget['new_id'],
                    'data' => $callback($data),
                    'expense_type_id' => $expenseType->uuid,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at,
                    ...$options,
                ]);
            });
    }

    /**
     * @param array{old_id: int, new_id: int} $budget
     * @param bool $isTemplate
     * @return void
     */
    private function restoreIncomes(array $budget, bool $isTemplate = false): void
    {
        $models = ['template' => IncomeTemplate::class, 'budget' => Income::class];
        $table = 'incomes';

        $this->restoreExpense($models, $table, $budget, $isTemplate, function ($data) {
            return new IncomeDto(
                name: $data->name,
                amount: $data->amount,
                pay_date: Carbon::parse($data->initial_pay_date),
            );
        });
    }

    /**
     * @param array{old_id: int, new_id: int} $budget
     * @param bool $isTemplate
     * @return void
     */
    private function restoreInvestments(array $budget, bool $isTemplate = false): void
    {
        $models = ['template' => InvestmentTemplate::class, 'budget' => Investment::class];
        $table = 'investments';

        $this->restoreExpense($models, $table, $budget, $isTemplate, function ($data) {
            return new ExpenseGainDto(
                name: $data->name,
                amount: $data->amount,
            );
        });
    }

    /**
     * @param array{old_id: int, new_id: int} $user
     * @return Collection
     */
    private function restoreUserVehicles(array $user): Collection
    {
        return $this->db
            ->table('user_vehicles')
            ->where('user_id', $user['old_id'])
            ->get()
            ->map(function ($data) use ($user) {
                $uv = UserVehicle::create([
                    'user_id' => $user['new_id'],
                    'data' => new UserVehicleDto(
                        color: $data->color,
                        make: $data->make,
                        model: $data->model,
                        year: $data->year,
                        license: $data->license,
                    ),
                ]);

                return ['old_id' => $data->id, 'new_id' => $uv->uuid];
            });
    }

    /**
     * @param array{old_id: int, new_id: int} $budget
     * @param array{old_id: int, new_id: int, vehicles: Collection} $user
     * @param bool $isTemplate
     * @return void
     */
    private function restoreVehicles(array $budget, array $user, bool $isTemplate = false): void
    {
        $models = ['template' => VehicleTemplate::class, 'budget' => Vehicle::class];
        $table = 'vehicles';

        $this->restoreExpense($models, $table, $budget, $isTemplate, function ($data) {
            return new VehicleDto(
                amount: $data->amount,
                balance: (float)$data->balance,
                due_date: $data->due_date,
                mileage: (int)$data->mileage ?? null,
                confirmation: $data->confirmation ?? null,
                notes: $data->notes ?? null,
                paid_date: ! empty($data->paid_date) ? Carbon::parse($data->paid_date) : null,
            );
        }, $user);
    }

    /**
     * @param array{old_id: int, new_id: int} $budgetArray
     * @return void
     */
    private function saveAggregations(array $budgetArray): void
    {
        $budget = Budget::query()
            ->withExpenses()
            ->where('id', $budgetArray['new_id'])
            ->firstOrFail();

        $this->commonExpenseService->saveAggregations($budget);
    }
}
