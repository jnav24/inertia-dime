<?php

namespace App\Models;

use App\Casts\EncryptedVehicle;
use App\Traits\HasUuids;
use App\Traits\WithBudget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes, HasUuids, WithBudget;

    protected $fillable = [
        'uuid',
        'data',
        'budget_id',
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

    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    public function expenseType(): BelongsTo
    {
        return $this->belongsTo(ExpenseType::class);
    }

    public function userVehicle(): BelongsTo
    {
        return $this->belongsTo(UserVehicle::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
