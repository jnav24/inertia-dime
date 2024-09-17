<?php

namespace App\Traits;

use Illuminate\Support\Facades\Hash;

trait HasPasswords
{
    protected static function bootHasPasswords(): void
    {
        self::creating(function ($model) {
            $key = $model->passwordKeyName ?? 'password';

            if (! Hash::info($model->{$key})['algo']) {
                $model->{$key} = Hash::make($model->{$key});
            }
        });
    }
}
