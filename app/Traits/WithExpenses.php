<?php

namespace App\Traits;

use App\Enums\CacheEnum;
use App\Models\BillType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

trait WithExpenses
{
    public function scopeWithExpenses(Builder $query): Builder
    {

        $relationships = (Cache::get(CacheEnum::BILL_TYPES->value) ?? BillType::all())
            ->pluck('slug')
            ->map(function ($slug) {
                $excludeTypes = ['miscellaneous'];
                $snakeSlug = Str::snake(Str::camel($slug));
                return ! in_array($snakeSlug, $excludeTypes) ? "{$snakeSlug}.type" : $snakeSlug;
            });

        if ($relationships->isNotEmpty()) {
            return $query->with(Arr::flatten($relationships->toArray()));
        }

        return $query;
    }
}
