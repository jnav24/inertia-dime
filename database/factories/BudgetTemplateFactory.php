<?php

namespace Database\Factories;

use App\Models\BudgetTemplate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BudgetTemplateFactory extends Factory
{
    protected $model = BudgetTemplate::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
        ];
    }
}
