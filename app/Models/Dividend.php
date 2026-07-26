<?php

namespace App\Models;

use App\Traits\HasUuids;
use App\Enums\FrequencyEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dividend extends Model
{
    use HasUuids;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'declaration_date' => 'datetime',
            'ex_date' => 'datetime',
            'frequency' => FrequencyEnum::class,
            'payout_date' => 'datetime',
            'record_date' => 'datetime',
        ];
    }

    public function userDividends(): HasMany
    {
        return $this->hasMany(UserDividend::class);
    }
}
