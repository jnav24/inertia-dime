<?php

namespace App\Models;

use App\Traits\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserDividend extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'dividend_id',
        'quantity',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dividend(): BelongsTo
    {
        return $this->belongsTo(Dividend::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(UserDividendTransaction::class);
    }
}
