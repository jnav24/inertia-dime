<?php

namespace App\Traits;

use App\Enums\ExpenseTypeEnum;
use Illuminate\Database\Eloquent\Builder;

trait WithExpenses
{
    public function scopeWithExpenses(Builder $query): Builder
    {
        return $query->with(ExpenseTypeEnum::allRelationships());
    }
}
