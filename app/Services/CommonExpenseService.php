<?php

namespace App\Services;

use App\Data\BudgetAggregationDto;
use App\Enums\BudgetAggregationEnum;
use App\Enums\ExpenseTypeEnum;
use App\Models\Bank;
use App\Models\BankTemplate;
use App\Models\Budget;
use App\Models\BudgetAggregation;
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
use App\Models\User;
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
    /**
     * @var array<string, array<string, string>>
     */
    protected array $models = [
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

    public function getModelByRequest(Request $request, bool $template): string
    {
        $key = $this->getKey($request);
        return $this->getModel($key, $template);
    }

    public function getModelByString(string $value, ?bool $template = false): string
    {
        $key = Str::singular($value);
        return $this->getModel($key, $template ?? false);
    }

    /**
     * @param BudgetTemplate $template
     * @param array<string, string> $validated
     * @return Budget
     * @throws Throwable
     */
    public function saveExpenses(BudgetTemplate $template, array $validated): Budget
    {
        try {
            DB::beginTransaction();

            /** @var User $user */
            $user = auth()->user();

            $budget = $user->budgets()->create([
                'name' => '',
                'budget_cycle' => Carbon::create((int) $validated['year'], (int) $validated['month']),
            ]);

            foreach (ExpenseTypeEnum::allExpenses() as $expense) {
                if (!method_exists($template, $expense)) {
                    continue;
                }

                foreach ($template->{$expense} as $data) {
                    if (! method_exists($budget, $expense)) {
                        continue;
                    }

                    if ($expense === ExpenseTypeEnum::INCOME->value) {
                        $data->data->pay_date->setMonth((int) $validated['month'])->setYear((int) $validated['year']);
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

    /**
     * @param Request $request
     * @param bool $template
     * @return array<string, int>
     */
    public function getBudgetRelationship(Request $request, bool $template): array
    {
        /** @var string $referrer */
        $referrer = $request->header('referer');

        if (! $template && $uuid = extractUuid($referrer)) {
            $budget = Budget::where('uuid', $uuid)->firstOrFail();
            return ['budget_id' => $budget->id];
        }

        /** @var User $user */
        $user = auth()->user();

        /** @var BudgetTemplate $budgetTemplate */
        $budgetTemplate = $user->budgetTemplate;

        return ['budget_template_id' => $budgetTemplate->id];
    }

    public function saveAggregations(Budget $budget, ?BudgetTemplate $template = null): void
    {
        $earned = $this->getAggregationSum(ExpenseTypeEnum::earned(), $template ?? $budget);
        $spent = $this->getAggregationSum(ExpenseTypeEnum::spend(), $template ?? $budget);
        $saved = $earned - $spent;

        BudgetAggregation::updateOrCreate(
            ['user_id' => $budget->user_id, 'budget_id' => $budget->id],
            [
                'data' => collect([
                    new BudgetAggregationDto(value: $earned, type: BudgetAggregationEnum::EARNED),
                    new BudgetAggregationDto(value: $spent, type: BudgetAggregationEnum::SPENT),
                    new BudgetAggregationDto(value: $saved, type: BudgetAggregationEnum::SAVED),
                ]),
            ],
        );
    }

    /**
     * @param Budget $budget
     * @return array<string, int>
     */
    public function getUnPaid(Budget $budget): array
    {
        return array_reduce(ExpenseTypeEnum::spend(), function ($result, $item) use ($budget) {
            $result[$item] = $budget->{$item}->reduce(function ($res, $expense) {
                return empty($expense->data->confirmation) ? $res + 1 : $res;
            }, 0);
            return $result;
        }, []);
    }

    public function deleteExpense(Request $request): string
    {
        $validated = $request->validate([
            'id' => ['required', 'uuid'],
            'template' => ['required', 'bool'],
        ]);

        $expense = $this->getModelByRequest($request, $validated['template'])::query()
            ->withBudget()
            ->where('uuid', $validated['id'])
            ->first();

        if (! empty($expense)) {
            $expense->delete();
        }

        return $expense?->data?->name ?? 'Item';
    }

    private function getKey(Request $request): string
    {
        $list = explode('/', $request->path());
        $count = count($list);

        if ($count === 3 || $count === 4) {
            return ! in_array($list[2], ['miscellaneous']) ? Str::singular($list[2]) : $list[2];
        }

        abort(Response::HTTP_BAD_REQUEST, 'Unable to get model');
    }

    /**
     * @param array<float> $types
     * @param BudgetTemplate|Budget $template
     * @return float
     */
    private function getAggregationSum(array $types, BudgetTemplate|Budget $template): float
    {
        return array_reduce($types, function ($result, $type) use ($template) {
            return $result + $template->{$type}->reduce(function ($res, $expense) {
                return $res + $expense->data->amount;
            }, 0.0);
        }, 0.0);
    }

    private function getModel(string $key, bool $template): string
    {
        if (empty($this->models[$key]) || empty($model = $this->models[$key][$template ? 'template' : 'budget'])) {
            abort(Response::HTTP_BAD_REQUEST, 'Model not found');
        }

        return $model;
    }
}
