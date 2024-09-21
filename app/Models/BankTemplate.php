<?php

namespace App\Models;

use App\Casts\EncryptedExpenseGain;
use App\Traits\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankTemplate extends Model
{
    use SoftDeletes, HasFactory, HasUuids;

    protected $fillable = [
        'uuid',
        'data',
        'expense_type_id',
        'budget_template_id',
    ];

    protected function casts(): array
    {
        return [
            'data' => EncryptedExpenseGain::class,
            'uuid' => 'string',
        ];
    }

    public function expenseType(): BelongsTo
    {
        return $this->belongsTo(related: ExpenseType::class, ownerKey: 'uuid');
    }

    public function budgetTemplate(): BelongsTo
    {
        return $this->belongsTo(BudgetTemplate::class);
    }
}