<?php

namespace Database\Factories;

use App\Models\BudgetTemplate;
use App\Models\ExpenseType;
use App\Models\InvestmentTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class InvestmentTemplateFactory extends Factory
{
    protected $model = InvestmentTemplate::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'data' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'expense_type_id' => ExpenseType::factory(),
            'budget_template_id' => BudgetTemplate::factory(),
        ];
    }
}
