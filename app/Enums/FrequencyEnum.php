<?php

namespace App\Enums;

enum FrequencyEnum: string {
    case Monthly = 'monthly';
    case Quarterly = 'quarterly';
    case Annually = 'annually';
    case Semiannual = 'semiannual';

    public static function fromApiValue(int|string $value): ?self
    {
        return match ($value) {
            12, 'Monthly' => self::Monthly,
            1, 'Annually' => self::Annually,
            2, 'Semiannual' => self::Semiannual,
            default => self::Quarterly,
        };
    }
}
