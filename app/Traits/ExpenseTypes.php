<?php

namespace App\Traits;

use App\Enums\CacheEnum;
use App\Models\ExpenseType;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

trait ExpenseTypes
{
    /**
     * @return array<string, array<int, array<string, string>>>
     */
    public function getAllExpenseTypes(): array
    {
        if (Cache::has(CacheEnum::EXPENSE_TYPES->value)) {
            return Cache::get(CacheEnum::EXPENSE_TYPES->value);
        }

        $results = (Cache::get(CacheEnum::BILL_TYPES->value) ?? ExpenseType::all())
            ->reduce(function ($result, $item) {
                $modelName = "{$item->model}Type";
                $model = "App\\Models\\{$modelName}";
                $result[Str::snake(Str::camel($item->slug))] = class_exists($model)
                    ? (new $model)->get()->toArray()
                    : [];

                return $result;
            }, []);

        return Cache::remember(CacheEnum::EXPENSE_TYPES->value, now()->addMinutes(60), fn () => $results);
    }
}
