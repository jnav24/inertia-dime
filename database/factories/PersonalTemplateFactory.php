<?php

namespace Database\Factories;

use App\Models\BudgetTemplate;
use App\Models\ExpenseType;
use App\Models\PersonalTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PersonalTemplateFactory extends Factory
{
    protected $model = PersonalTemplate::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'data' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'budget_template_id' => BudgetTemplate::factory(),
            'expense_type_id' => ExpenseType::factory(),
        ];
    }
}
