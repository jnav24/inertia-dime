<?php

namespace App\Models;

use App\Traits\HasUuids;
use App\Enums\TransactionEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDividendTransaction extends Model
{
    use HasUuids;

    protected $fillable = [
        'uuid',
        'transaction_type',
        'quantity',
        'price',
        'transaction_date',
        'user_dividend_id',
    ];

    protected function casts(): array
    {
        return [
            'transaction_date' => 'datetime',
            'transaction_type' => TransactionEnum::class,
        ];
    }

    public function userDividend(): BelongsTo
    {
        return $this->belongsTo(UserDividend::class);
    }
}
