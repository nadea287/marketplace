<?php

namespace App\Enums;

use Illuminate\Support\Arr;

enum UserTypeEnum: string
{
    case Client = 'client';
    case Seller = 'seller';

    public static function getCasesArray()
    {
        return Arr::map(self::cases(), fn($enum) => $enum->value);
    }
}
