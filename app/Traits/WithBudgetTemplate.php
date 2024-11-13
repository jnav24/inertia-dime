<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait WithBudgetTemplate
{
    public function scopeWithBudget(Builder $query): Builder
    {
        return $query->with(['budgetTemplate' => fn ($budget) => $budget->where('user_id', auth()->user()->id)]);
    }
}
