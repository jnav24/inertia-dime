<?php

namespace App\Models;

use App\Casts\EncryptedBudgetAggregation;
use App\Traits\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BudgetAggregation extends Model
{
    use SoftDeletes, HasFactory, HasUuids;

    protected $fillable = [
        'data',
        'uuid',
        'budget_id',
    ];

    protected function casts(): array
    {
        return [
            'data' => EncryptedBudgetAggregation::class,
            'uuid' => 'string',
        ];
    }

    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }
}