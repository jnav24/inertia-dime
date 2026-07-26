<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDividend extends Model
{
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
}
