<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait WithBudget
{
    public function scopeWithBudget(Builder $query): Builder
    {
        return $query->with(['budget' => fn ($budget) => $budget->where('user_id', auth()->user()->id)]);
    }
}
