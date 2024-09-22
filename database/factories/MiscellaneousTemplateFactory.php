<?php

namespace Database\Factories;

use App\Models\BudgetTemplate;
use App\Models\MiscellaneousTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MiscellaneousTemplateFactory extends Factory
{
    protected $model = MiscellaneousTemplate::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'data' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'budget_template_id' => BudgetTemplate::factory(),
        ];
    }
}
