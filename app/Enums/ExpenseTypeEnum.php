<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum ExpenseTypeEnum: string
{
    case BANK = 'bank';
    case CHILDCARE = 'childcare';
    case CREDIT_CARD = 'creditCards';
    case EDUCATION = 'education';
    case ENTERTAINMENT = 'entertainment';
    case FOOD = 'food';
    case GIFT = 'gift';
    case HOUSING = 'housing';
    case INCOME = 'income';
    case INVESTMENT = 'investment';
    case LOAN = 'loan';
    case MEDICAL = 'medical';
    case MISCELLANEOUS = 'miscellaneous';
    case PERSONAL = 'personal';
    case SHOPPING = 'shopping';
    case SUBSCRIPTION = 'subscription';
    case TAX = 'tax';
    case TRAVEL = 'travel';
    case UTILITY = 'utility';
    case VEHICLE = 'vehicle';

    /**
     * @return array<string>
     */
    public static function allTypes(): array
    {
        return array_map(fn ($item) => Str::title($item->value), ExpenseTypeEnum::cases());
    }

    /**
     * @return array<string>
     */
    public static function allRelationships(): array
    {
        return [
            ...array_map(fn ($item) => Str::camel(Str::plural($item->value) . ".expenseType"), ExpenseTypeEnum::cases()),
            'vehicles.userVehicle'
        ];
    }
}
