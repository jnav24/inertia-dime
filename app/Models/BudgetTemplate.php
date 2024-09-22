<?php

namespace App\Models;

use App\Traits\HasUuids;
use App\Traits\WithExpenses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BudgetTemplate extends Model
{
    use HasFactory, HasUuids, SoftDeletes, WithExpenses;

    protected $fillable = [
        'uuid',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'uuid' => 'string',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function banks(): HasMany
    {
        return $this->hasMany(BankTemplate::class);
    }

    public function childcares(): HasMany
    {
        return $this->hasMany(ChildcareTemplate::class);
    }

    public function creditCards(): HasMany
    {
        return $this->hasMany(CreditCardTemplate::class);
    }

    public function education(): HasMany
    {
        return $this->hasMany(EducationTemplate::class);
    }

    public function entertainments(): HasMany
    {
        return $this->hasMany(EntertainmentTemplate::class);
    }

    public function food(): HasMany
    {
        return $this->hasMany(FoodTemplate::class);
    }

    public function gifts(): HasMany
    {
        return $this->hasMany(GiftTemplate::class);
    }

    public function housings(): HasMany
    {
        return $this->hasMany(HousingTemplate::class);
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(IncomeTemplate::class);
    }

    public function investments(): HasMany
    {
        return $this->hasMany(InvestmentTemplate::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(LoanTemplate::class);
    }

    public function medicals(): HasMany
    {
        return $this->hasMany(MedicalTemplate::class);
    }

    public function miscellaneouses(): HasMany
    {
        return $this->hasMany(MiscellaneousTemplate::class);
    }

    public function personals(): HasMany
    {
        return $this->hasMany(PersonalTemplate::class);
    }

    public function shoppings(): HasMany
    {
        return $this->hasMany(ShoppingTemplate::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(SubscriptionTemplate::class);
    }

    public function taxes(): HasMany
    {
        return $this->hasMany(TaxTemplate::class);
    }

    public function travel(): HasMany
    {
        return $this->hasMany(TravelTemplate::class);
    }

    public function utilities(): HasMany
    {
        return $this->hasMany(UtilityTemplate::class);
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(VehicleTemplate::class);
    }
}
