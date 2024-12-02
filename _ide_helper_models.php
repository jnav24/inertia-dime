<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseGainDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Bank withoutTrashed()
 */
	class Bank extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseGainDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\BankTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankTemplate withoutTrashed()
 */
	class BankTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property \Illuminate\Support\Carbon $budget_cycle
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetAggregation|null $aggregation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Bank> $banks
 * @property-read int|null $banks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Childcare> $childcares
 * @property-read int|null $childcares_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CreditCard> $creditCards
 * @property-read int|null $credit_cards_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Education> $education
 * @property-read int|null $education_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Entertainment> $entertainments
 * @property-read int|null $entertainments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Food> $food
 * @property-read int|null $food_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Gift> $gifts
 * @property-read int|null $gifts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Housing> $housings
 * @property-read int|null $housings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Income> $incomes
 * @property-read int|null $incomes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Investment> $investments
 * @property-read int|null $investments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Loan> $loans
 * @property-read int|null $loans_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Medical> $medicals
 * @property-read int|null $medicals_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Miscellaneous> $miscellaneouses
 * @property-read int|null $miscellaneouses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Personal> $personals
 * @property-read int|null $personals_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Shopping> $shoppings
 * @property-read int|null $shoppings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subscription> $subscriptions
 * @property-read int|null $subscriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tax> $taxes
 * @property-read int|null $taxes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Travel> $travel
 * @property-read int|null $travel_count
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Utility> $utilities
 * @property-read int|null $utilities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Vehicle> $vehicles
 * @property-read int|null $vehicles_count
 * @method static \Database\Factories\BudgetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereBudgetCycle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget withExpenses()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget withoutTrashed()
 */
	class Budget extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \Illuminate\Support\Collection $data
 * @property int $user_id
 * @property int $budget_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\BudgetAggregationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetAggregation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetAggregation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetAggregation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetAggregation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetAggregation whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetAggregation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetAggregation whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetAggregation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetAggregation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetAggregation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetAggregation whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetAggregation whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetAggregation withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetAggregation withoutTrashed()
 */
	class BudgetAggregation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BankTemplate> $banks
 * @property-read int|null $banks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ChildcareTemplate> $childcares
 * @property-read int|null $childcares_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CreditCardTemplate> $creditCards
 * @property-read int|null $credit_cards_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EducationTemplate> $education
 * @property-read int|null $education_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EntertainmentTemplate> $entertainments
 * @property-read int|null $entertainments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FoodTemplate> $food
 * @property-read int|null $food_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\GiftTemplate> $gifts
 * @property-read int|null $gifts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HousingTemplate> $housings
 * @property-read int|null $housings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IncomeTemplate> $incomes
 * @property-read int|null $incomes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InvestmentTemplate> $investments
 * @property-read int|null $investments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LoanTemplate> $loans
 * @property-read int|null $loans_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MedicalTemplate> $medicals
 * @property-read int|null $medicals_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MiscellaneousTemplate> $miscellaneouses
 * @property-read int|null $miscellaneouses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PersonalTemplate> $personals
 * @property-read int|null $personals_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ShoppingTemplate> $shoppings
 * @property-read int|null $shoppings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SubscriptionTemplate> $subscriptions
 * @property-read int|null $subscriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TaxTemplate> $taxes
 * @property-read int|null $taxes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TravelTemplate> $travel
 * @property-read int|null $travel_count
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UtilityTemplate> $utilities
 * @property-read int|null $utilities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VehicleTemplate> $vehicles
 * @property-read int|null $vehicles_count
 * @method static \Database\Factories\BudgetTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetTemplate whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetTemplate withExpenses()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetTemplate withoutTrashed()
 */
	class BudgetTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Childcare newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Childcare newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Childcare onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Childcare query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Childcare whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Childcare whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Childcare whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Childcare whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Childcare whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Childcare whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Childcare whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Childcare whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Childcare withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Childcare withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Childcare withoutTrashed()
 */
	class Childcare extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\ChildcareTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChildcareTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChildcareTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChildcareTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChildcareTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChildcareTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChildcareTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChildcareTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChildcareTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChildcareTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChildcareTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChildcareTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChildcareTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChildcareTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChildcareTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChildcareTemplate withoutTrashed()
 */
	class ChildcareTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\CreditCardDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCard onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCard query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCard whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCard whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCard whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCard whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCard whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCard withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCard withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCard withoutTrashed()
 */
	class CreditCard extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\CreditCardDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\CreditCardTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCardTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCardTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCardTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCardTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCardTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCardTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCardTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCardTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCardTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCardTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCardTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCardTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCardTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCardTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditCardTemplate withoutTrashed()
 */
	class CreditCardTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Education newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Education newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Education onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Education query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Education whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Education whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Education whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Education whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Education whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Education whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Education whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Education whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Education withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Education withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Education withoutTrashed()
 */
	class Education extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\EducationTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationTemplate withoutTrashed()
 */
	class EducationTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entertainment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entertainment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entertainment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entertainment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entertainment whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entertainment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entertainment whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entertainment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entertainment whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entertainment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entertainment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entertainment whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entertainment withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entertainment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Entertainment withoutTrashed()
 */
	class Entertainment extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\EntertainmentTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EntertainmentTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EntertainmentTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EntertainmentTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EntertainmentTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EntertainmentTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EntertainmentTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EntertainmentTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EntertainmentTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EntertainmentTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EntertainmentTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EntertainmentTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EntertainmentTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EntertainmentTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EntertainmentTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EntertainmentTemplate withoutTrashed()
 */
	class EntertainmentTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $slug
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ExpenseTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExpenseType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExpenseType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExpenseType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExpenseType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExpenseType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExpenseType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExpenseType whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExpenseType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExpenseType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExpenseType whereUuid($value)
 */
	class ExpenseType extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food withoutTrashed()
 */
	class Food extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\FoodTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FoodTemplate withoutTrashed()
 */
	class FoodTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gift newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gift newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gift onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gift query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gift whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gift whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gift whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gift whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gift whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gift whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gift whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gift whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gift withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gift withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gift withoutTrashed()
 */
	class Gift extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\GiftTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GiftTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GiftTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GiftTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GiftTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GiftTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GiftTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GiftTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GiftTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GiftTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GiftTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GiftTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GiftTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GiftTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GiftTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GiftTemplate withoutTrashed()
 */
	class GiftTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Housing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Housing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Housing onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Housing query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Housing whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Housing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Housing whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Housing whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Housing whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Housing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Housing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Housing whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Housing withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Housing withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Housing withoutTrashed()
 */
	class Housing extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\HousingTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HousingTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HousingTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HousingTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HousingTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HousingTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HousingTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HousingTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HousingTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HousingTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HousingTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HousingTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HousingTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HousingTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HousingTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HousingTemplate withoutTrashed()
 */
	class HousingTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property mixed $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income withoutTrashed()
 */
	class Income extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property mixed $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\IncomeTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomeTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomeTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomeTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomeTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomeTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomeTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomeTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomeTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomeTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomeTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomeTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomeTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomeTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomeTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IncomeTemplate withoutTrashed()
 */
	class IncomeTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseGainDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Investment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Investment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Investment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Investment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Investment whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Investment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Investment whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Investment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Investment whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Investment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Investment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Investment whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Investment withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Investment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Investment withoutTrashed()
 */
	class Investment extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseGainDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\InvestmentTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvestmentTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvestmentTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvestmentTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvestmentTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvestmentTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvestmentTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvestmentTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvestmentTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvestmentTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvestmentTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvestmentTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvestmentTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvestmentTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvestmentTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvestmentTemplate withoutTrashed()
 */
	class InvestmentTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Loan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Loan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Loan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Loan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Loan whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Loan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Loan whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Loan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Loan whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Loan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Loan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Loan whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Loan withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Loan withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Loan withoutTrashed()
 */
	class Loan extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\LoanTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoanTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoanTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoanTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoanTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoanTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoanTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoanTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoanTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoanTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoanTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoanTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoanTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoanTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoanTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LoanTemplate withoutTrashed()
 */
	class LoanTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medical newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medical newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medical onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medical query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medical whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medical whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medical whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medical whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medical whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medical whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medical whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medical whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medical withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medical withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medical withoutTrashed()
 */
	class Medical extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\MedicalTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicalTemplate withoutTrashed()
 */
	class MedicalTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Miscellaneous newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Miscellaneous newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Miscellaneous onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Miscellaneous query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Miscellaneous whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Miscellaneous whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Miscellaneous whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Miscellaneous whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Miscellaneous whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Miscellaneous whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Miscellaneous whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Miscellaneous whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Miscellaneous withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Miscellaneous withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Miscellaneous withoutTrashed()
 */
	class Miscellaneous extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\MiscellaneousTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MiscellaneousTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MiscellaneousTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MiscellaneousTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MiscellaneousTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MiscellaneousTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MiscellaneousTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MiscellaneousTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MiscellaneousTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MiscellaneousTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MiscellaneousTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MiscellaneousTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MiscellaneousTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MiscellaneousTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MiscellaneousTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MiscellaneousTemplate withoutTrashed()
 */
	class MiscellaneousTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Personal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Personal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Personal onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Personal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Personal whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Personal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Personal whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Personal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Personal whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Personal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Personal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Personal whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Personal withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Personal withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Personal withoutTrashed()
 */
	class Personal extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\PersonalTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PersonalTemplate withoutTrashed()
 */
	class PersonalTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shopping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shopping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shopping onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shopping query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shopping whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shopping whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shopping whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shopping whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shopping whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shopping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shopping whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shopping whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shopping withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shopping withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Shopping withoutTrashed()
 */
	class Shopping extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\ShoppingTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShoppingTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShoppingTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShoppingTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShoppingTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShoppingTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShoppingTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShoppingTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShoppingTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShoppingTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShoppingTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShoppingTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShoppingTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShoppingTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShoppingTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShoppingTemplate withoutTrashed()
 */
	class ShoppingTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscription withoutTrashed()
 */
	class Subscription extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\SubscriptionTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionTemplate withoutTrashed()
 */
	class SubscriptionTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \App\Data\ExpenseSpendDto $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tax newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tax newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tax onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tax query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tax whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tax whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tax whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tax whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tax whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tax whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tax whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tax whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tax withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tax withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tax withoutTrashed()
 */
	class Tax extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \App\Data\ExpenseSpendDto $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\TaxTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TaxTemplate withoutTrashed()
 */
	class TaxTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Travel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Travel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Travel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Travel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Travel whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Travel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Travel whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Travel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Travel whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Travel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Travel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Travel whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Travel withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Travel withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Travel withoutTrashed()
 */
	class Travel extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\TravelTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TravelTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TravelTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TravelTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TravelTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TravelTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TravelTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TravelTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TravelTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TravelTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TravelTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TravelTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TravelTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TravelTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TravelTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TravelTemplate withoutTrashed()
 */
	class TravelTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * Class User
 * 
 * Represents a user in the application.
 * This class extends the base Authenticatable class and implements the MustVerifyEmail interface.
 *
 * @package App\Models
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @uses HasFactory<UserFactory>
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $mfa_secret
 * @property string|null $mfa_recovery_codes
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BudgetAggregation> $aggregations
 * @property-read int|null $aggregations_count
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Budget> $budgets
 * @property-read int|null $budgets_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserVehicle> $userVehicles
 * @property-read int|null $user_vehicles_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereMfaRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereMfaSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property \App\Data\UserVehicleDto $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\Vehicle|null $vehicle
 * @method static \Database\Factories\UserVehicleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVehicle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVehicle whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVehicle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVehicle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVehicle whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVehicle whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVehicle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserVehicle withoutTrashed()
 */
	class UserVehicle extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Utility withoutTrashed()
 */
	class Utility extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\ExpenseSpendDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\UtilityTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UtilityTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UtilityTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UtilityTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UtilityTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UtilityTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UtilityTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UtilityTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UtilityTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UtilityTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UtilityTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UtilityTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UtilityTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UtilityTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UtilityTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UtilityTemplate withoutTrashed()
 */
	class UtilityTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\VehicleDto $data
 * @property int $budget_id
 * @property string $expense_type_id
 * @property string $user_vehicle_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\ExpenseType $expenseType
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\UserVehicle $userVehicle
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vehicle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vehicle whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vehicle whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vehicle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vehicle whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vehicle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vehicle whereUserVehicleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vehicle whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vehicle withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vehicle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vehicle withoutTrashed()
 */
	class Vehicle extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Data\VehicleDto $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property string $user_vehicle_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\UserVehicle $userVehicle
 * @method static \Database\Factories\VehicleTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VehicleTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VehicleTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VehicleTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VehicleTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VehicleTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VehicleTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VehicleTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VehicleTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VehicleTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VehicleTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VehicleTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VehicleTemplate whereUserVehicleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VehicleTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VehicleTemplate withBudget()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VehicleTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|VehicleTemplate withoutTrashed()
 */
	class VehicleTemplate extends \Eloquent {}
}

