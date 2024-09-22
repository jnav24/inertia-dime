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
 * @property \Illuminate\Support\Collection $data
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\BankTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|BankTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BankTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|BankTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BankTemplate withoutTrashed()
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
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\BudgetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Budget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget query()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereBudgetCycle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget withoutTrashed()
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
 * @property int $budget_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Budget $budget
 * @method static \Database\Factories\BudgetAggregationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetAggregation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetAggregation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetAggregation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetAggregation query()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetAggregation whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetAggregation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetAggregation whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetAggregation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetAggregation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetAggregation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetAggregation whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetAggregation withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetAggregation withoutTrashed()
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
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\BudgetTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetTemplate whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetTemplate withExpenses()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetTemplate withoutTrashed()
 */
	class BudgetTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \App\Models\ExpenseType|null $expenseType
 * @method static \Database\Factories\ChildcareTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ChildcareTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChildcareTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChildcareTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ChildcareTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChildcareTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ChildcareTemplate withoutTrashed()
 */
	class ChildcareTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \App\Models\ExpenseType|null $expenseType
 * @method static \Database\Factories\CreditCardTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCardTemplate withoutTrashed()
 */
	class CreditCardTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \App\Models\ExpenseType|null $expenseType
 * @method static \Database\Factories\EducationTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|EducationTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EducationTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EducationTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EducationTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|EducationTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EducationTemplate withoutTrashed()
 */
	class EducationTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \App\Models\ExpenseType|null $expenseType
 * @method static \Database\Factories\EntertainmentTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|EntertainmentTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntertainmentTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntertainmentTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EntertainmentTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|EntertainmentTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EntertainmentTemplate withoutTrashed()
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
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExpenseType whereUuid($value)
 */
	class ExpenseType extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \App\Models\ExpenseType|null $expenseType
 * @method static \Database\Factories\FoodTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|FoodTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FoodTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FoodTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FoodTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|FoodTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FoodTemplate withoutTrashed()
 */
	class FoodTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \App\Models\ExpenseType|null $expenseType
 * @method static \Database\Factories\GiftTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|GiftTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GiftTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GiftTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GiftTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|GiftTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GiftTemplate withoutTrashed()
 */
	class GiftTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \App\Models\ExpenseType|null $expenseType
 * @method static \Database\Factories\HousingTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|HousingTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HousingTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HousingTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HousingTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|HousingTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|HousingTemplate withoutTrashed()
 */
	class HousingTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \App\Models\ExpenseType|null $expenseType
 * @method static \Database\Factories\IncomeTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTemplate withoutTrashed()
 */
	class IncomeTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property \Illuminate\Support\Collection $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \App\Models\ExpenseType|null $expenseType
 * @method static \Database\Factories\InvestmentTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|InvestmentTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvestmentTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvestmentTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvestmentTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvestmentTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InvestmentTemplate withoutTrashed()
 */
	class InvestmentTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \App\Models\ExpenseType|null $expenseType
 * @method static \Database\Factories\LoanTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|LoanTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanTemplate withoutTrashed()
 */
	class LoanTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \App\Models\ExpenseType|null $expenseType
 * @method static \Database\Factories\MedicalTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|MedicalTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MedicalTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MedicalTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MedicalTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|MedicalTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MedicalTemplate withoutTrashed()
 */
	class MedicalTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @method static \Database\Factories\MiscellaneousTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MiscellaneousTemplate withoutTrashed()
 */
	class MiscellaneousTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \App\Models\ExpenseType|null $expenseType
 * @method static \Database\Factories\PersonalTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalTemplate withoutTrashed()
 */
	class PersonalTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \App\Models\ExpenseType|null $expenseType
 * @method static \Database\Factories\ShoppingTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ShoppingTemplate withoutTrashed()
 */
	class ShoppingTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \App\Models\ExpenseType|null $expenseType
 * @method static \Database\Factories\SubscriptionTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionTemplate withoutTrashed()
 */
	class SubscriptionTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property int $budget_template_id
 * @property string $expense_type_id
 * @property mixed $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\BudgetTemplate $budgetTemplate
 * @property-read \App\Models\ExpenseType $expenseType
 * @method static \Database\Factories\TaxTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TaxTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxTemplate withoutTrashed()
 */
	class TaxTemplate extends \Eloquent {}
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
 * @method static \Database\Factories\TravelTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TravelTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TravelTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TravelTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TravelTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|TravelTemplate whereBudgetTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TravelTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TravelTemplate whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TravelTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TravelTemplate whereExpenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TravelTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TravelTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TravelTemplate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TravelTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TravelTemplate withoutTrashed()
 */
	class TravelTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Budget> $budgets
 * @property-read int|null $budgets_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\UserVehicleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserVehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVehicle onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVehicle withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVehicle withoutTrashed()
 */
	class UserVehicle extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \App\Models\ExpenseType|null $expenseType
 * @method static \Database\Factories\UtilityTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UtilityTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UtilityTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UtilityTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UtilityTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|UtilityTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UtilityTemplate withoutTrashed()
 */
	class UtilityTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property mixed $data
 * @property-read \App\Models\BudgetTemplate|null $budgetTemplate
 * @property-read \App\Models\ExpenseType|null $expenseType
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\VehicleTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleTemplate withoutTrashed()
 */
	class VehicleTemplate extends \Eloquent {}
}

