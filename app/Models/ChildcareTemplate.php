<?php

namespace App\Models;

use App\Casts\EncryptedExpenseSpend;
use App\Traits\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChildcareTemplate extends Model
{
    use SoftDeletes, HasFactory, HasUuids;

    protected $fillable = [
        'uuid',
        'data',
        'budget_template_id',
        'expense_type_id',
    ];

    protected function casts(): array
    {
        return [
            'data' => EncryptedExpenseSpend::class,
            'uuid' => 'string',
        ];
    }

    public function budgetTemplate(): BelongsTo
    {
        return $this->belongsTo(BudgetTemplate::class);
    }

    public function expenseType(): BelongsTo
    {
        return $this->belongsTo(related: ExpenseType::class, ownerKey: 'uuid');
    }
}
