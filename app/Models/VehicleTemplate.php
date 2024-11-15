<?php

namespace App\Models;

use App\Casts\EncryptedVehicle;
use App\Traits\HasUuids;
use App\Traits\WithBudgetTemplate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleTemplate extends Model
{
    use SoftDeletes, HasFactory, HasUuids, WithBudgetTemplate;

    protected $fillable = [
        'uuid',
        'data',
        'budget_template_id',
        'expense_type_id',
        'user_vehicle_id',
    ];

    protected function casts(): array
    {
        return [
            'data' => EncryptedVehicle::class,
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

    public function userVehicle(): BelongsTo
    {
        return $this->belongsTo(related: UserVehicle::class, ownerKey: 'uuid');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
