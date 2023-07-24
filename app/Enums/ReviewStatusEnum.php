<?php

namespace App\Enums;

use Illuminate\Support\Arr;

enum ReviewStatusEnum: int
{
    case Active = 1;
    case Inactive = 0;

    public static function getCasesArray()
    {
        return Arr::map(self::cases(), fn($enum) => $enum->value);
    }
}
