<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuids
{
    protected static function bootHasUuids(): void
    {
        static::creating(function ($model) {
            $key = $model->uuidKeyName ?? 'uuid';

            if (empty($model->{$key})) {
                $model->{$key} = Str::uuid()->toString();
            }
        });
    }
}
