<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum ExpenseTypeEnum: string
{
    case BANK = 'bank';
    case CHILDCARE = 'childcare';
    case CREDIT_CARD = 'credit card';
    case EDUCATION = 'education';
    case ENTERTAINMENT = 'entertainment';
    case FOOD = 'food';
    case GIFT = 'gift';
    case HOUSING = 'housing';
    case INCOME = 'income';
    case INVESTMENT = 'investment';
    case LOAN = 'loan';
    case MEDICAL = 'medical';
    case PERSONAL = 'personal';
    case SHOPPING = 'shopping';
    case SUBSCRIPTION = 'subscription';
    case TAX = 'tax';
    case TRAVEL = 'travel';
    case UTILITY = 'utilities';
    case VEHICLE = 'vehicle';

    public function allTypes()
    {
        return array_map(fn ($item) => Str::title($item->value), ExpenseTypeEnum::cases());
    }
}
