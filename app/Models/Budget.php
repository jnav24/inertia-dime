<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'budget_cycle',
        'user_id',
        'uuid',
    ];

    protected function casts(): array
    {
        return [
            'budget_cycle' => 'datetime',
            'uuid' => 'string',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function aggregation(): HasOne
    {
        return $this->hasOne(BudgetAggregation::class);
    }
}
