<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\BudgetAggregation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BudgetAggregationFactory extends Factory
{
    protected $model = BudgetAggregation::class;

    public function definition(): array
    {
        return [
            'data' => $this->faker->word(),
            'uuid' => $this->faker->uuid(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'budget_id' => Budget::factory(),
        ];
    }
}
