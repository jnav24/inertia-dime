<?php

namespace App\Services;

use App\Enums\ExpenseTypeEnum;
use App\Models\Bank;
use App\Models\BankTemplate;
use App\Models\Budget;
use App\Models\BudgetTemplate;
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
use App\Models\Utility;
use App\Models\UtilityTemplate;
use App\Models\Vehicle;
use App\Models\VehicleTemplate;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class CommonExpenseService
{
    protected $models = [
        'bank' => [
            'budget' => Bank::class,
            'template' => BankTemplate::class,
        ],
        'childcare' => [
            'budget' => Childcare::class,
            'template' => ChildcareTemplate::class,
        ],
        'creditCard' => [
            'budget' => CreditCard::class,
            'template' => CreditCardTemplate::class,
        ],
        'education' => [
            'budget' => Education::class,
            'template' => EducationTemplate::class,
        ],
        'entertainment' => [
            'budget' => Entertainment::class,
            'template' => EntertainmentTemplate::class,
        ],
        'food' => [
            'budget' => Food::class,
            'template' => FoodTemplate::class,
        ],
        'gift' => [
            'budget' => Gift::class,
            'template' => GiftTemplate::class,
        ],
        'housing' => [
            'budget' => Housing::class,
            'template' => HousingTemplate::class,
        ],
        'income' => [
            'budget' => Income::class,
            'template' => IncomeTemplate::class,
        ],
        'investment' => [
            'budget' => Investment::class,
            'template' => InvestmentTemplate::class,
        ],
        'loan' => [
            'budget' => Loan::class,
            'template' => LoanTemplate::class,
        ],
        'medical' => [
            'budget' => Medical::class,
            'template' => MedicalTemplate::class,
        ],
        'miscellaneous' => [
            'budget' => Miscellaneous::class,
            'template' => MiscellaneousTemplate::class,
        ],
        'personal' => [
            'budget' => Personal::class,
            'template' => PersonalTemplate::class,
        ],
        'shopping' => [
            'budget' => Shopping::class,
            'template' => ShoppingTemplate::class,
        ],
        'subscription' => [
            'budget' => Subscription::class,
            'template' => SubscriptionTemplate::class,
        ],
        'tax' => [
            'budget' => Tax::class,
            'template' => TaxTemplate::class,
        ],
        'travel' => [
            'budget' => Travel::class,
            'template' => TravelTemplate::class,
        ],
        'utility' => [
            'budget' => Utility::class,
            'template' => UtilityTemplate::class,
        ],
        'vehicle' => [
            'budget' => Vehicle::class,
            'template' => VehicleTemplate::class,
        ],
    ];

    public function getModel(Request $request, bool $template)
    {
        $key = $this->getKey($request);

        if (empty($this->models[$key]) || empty($model = $this->models[$key][$template ? 'template' : 'budget'])) {
            abort(Response::HTTP_BAD_REQUEST, 'Model not found');
        }

        return $model;
    }

    public function saveExpenses(BudgetTemplate $template, array $validated): Budget
    {
        try {
            DB::beginTransaction();

            $budget = auth()->user()->budgets()->create([
                'name' => '',
                'budget_cycle' => Carbon::create((int) $validated['year'], (int) $validated['month']),
            ]);

            foreach (ExpenseTypeEnum::allExpenses() as $expense) {
                if (!method_exists($template, $expense)) {
                    continue;
                }

                foreach ($template->{$expense} as $data) {
                    if (!method_exists($budget, $expense)) {
                        continue;
                    }

                    Log::info("Expense: {$expense}, Data: {$data}");
                    $budget->{$expense}()->create([
                        'data' => $data->data,
                        'expense_type_id' => $data->expense_type_id,
                        'user_vehicle_id' => $data->user_vehicle_id ?? null,
                    ]);
                }
            }

            DB::commit();
            return $budget;
        } catch (Throwable $e) {
            DB::rollBack();
//            Log::debug("Expense: {$expense}, Data: {$data}");
            throw new Exception($e->getMessage());
        }
    }

    public function getBudgetRelationship(Request $request, bool $template): array
    {
        if (! $template && $uuid = extractUuid($request->header('referer'))) {
            $budget = Budget::where('uuid', $uuid)->firstOrFail();
            return ['budget_id' => $budget->id];
        }

        return ['budget_template_id' => auth()->user()->budgetTemplate->id];
    }

    private function getKey(Request $request)
    {
        $list = explode('/', $request->path());
        $count = count($list);

        if ($count === 3 || $count === 4) {
            return Str::singular($list[2]);
        }

        abort(Response::HTTP_BAD_REQUEST, 'Unable to get model');
    }
}
