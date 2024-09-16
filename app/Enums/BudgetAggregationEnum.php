<?php

namespace App\Enums;

enum BudgetAggregationEnum: string
{
    case EARNED = 'earned';
    case SAVED = 'saved';
    case SPENT = 'spent';
}
