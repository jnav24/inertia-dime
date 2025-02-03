<?php

namespace App\Enums;

enum CacheEnum: string
{
    case BILL_TYPES = 'bill_types';
    case DISPLAY_MFA = 'display_mfa';
    case EXPENSE_TYPES = 'expense_types';
}
