<?php

namespace App\Models;

use App\Traits\HasUuids;
use App\Traits\WithExpenses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use HasFactory, HasUuids, SoftDeletes, WithExpenses;

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

    public function banks(): HasMany
    {
        return $this->hasMany(Bank::class);
    }

    public function childcares(): HasMany
    {
        return $this->hasMany(Childcare::class);
    }

    public function creditCards(): HasMany
    {
        return $this->hasMany(CreditCard::class);
    }

    public function education(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    public function entertainments(): HasMany
    {
        return $this->hasMany(Entertainment::class);
    }

    public function food(): HasMany
    {
        return $this->hasMany(Food::class);
    }

    public function gifts(): HasMany
    {
        return $this->hasMany(Gift::class);
    }

    public function housings(): HasMany
    {
        return $this->hasMany(Housing::class);
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class);
    }

    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function medicals(): HasMany
    {
        return $this->hasMany(Medical::class);
    }

    public function miscellaneouses(): HasMany
    {
        return $this->hasMany(Miscellaneous::class);
    }

    public function personals(): HasMany
    {
        return $this->hasMany(Personal::class);
    }

    public function shoppings(): HasMany
    {
        return $this->hasMany(Shopping::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function taxes(): HasMany
    {
        return $this->hasMany(Tax::class);
    }

    public function travel(): HasMany
    {
        return $this->hasMany(Travel::class);
    }

    public function utilities(): HasMany
    {
        return $this->hasMany(Utility::class);
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}
