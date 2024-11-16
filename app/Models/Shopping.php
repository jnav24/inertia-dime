<?php

namespace App\Models;

use App\Casts\EncryptedExpenseSpend;
use App\Traits\HasUuids;
use App\Traits\WithBudget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shopping extends Model
{
    use SoftDeletes, HasUuids, WithBudget;

    protected $fillable = [
        'uuid',
        'data',
        'budget_id',
        'expense_type_id',
    ];

    protected function casts(): array
    {
        return [
            'data' => EncryptedExpenseSpend::class,
            'uuid' => 'string',
        ];
    }

    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    public function expenseType(): BelongsTo
    {
        return $this->belongsTo(ExpenseType::class, ownerKey: 'uuid');
    }
}
