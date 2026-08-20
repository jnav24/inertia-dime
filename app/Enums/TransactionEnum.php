<?php

namespace App\Enums;

enum TransactionEnum: string
{
    case BUY = 'bought';
    case SELL = 'sold';
    case REINVEST = 'reinvested';
}
