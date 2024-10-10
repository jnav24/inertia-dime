<?php

namespace App\Models;

use App\Enums\CacheEnum;
use App\Traits\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ExpenseType extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'type',
    ];

    protected function casts(): array
    {
        return [
            'uuid' => 'string',
        ];
    }

    public static function cached()
    {
        return Cache::get(CacheEnum::EXPENSE_TYPES->value) ??
            Cache::remember(CacheEnum::EXPENSE_TYPES->value, now()->addDay(), fn () => static::get());
    }

    public static function grouped()
    {
        return static::cached()
            ->groupBy(fn ($item) => Str::plural($item->type))
            ->sortKeys();
    }
}
