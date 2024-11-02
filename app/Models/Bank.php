<?php

namespace App\Models;

use App\Casts\EncryptedExpenseGain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'data',
        'budget_id',
        'expense_type_id',
    ];

    protected function casts(): array
    {
        return [
            'data' => EncryptedExpenseGain::class,
            'uuid' => 'string',
        ];
    }

    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    public function expenseType(): BelongsTo
    {
        return $this->belongsTo(related: ExpenseType::class, ownerKey: 'uuid');
    }
}