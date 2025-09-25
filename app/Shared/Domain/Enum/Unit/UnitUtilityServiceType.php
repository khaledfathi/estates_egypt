<?php

declare(strict_types=1);

namespace App\Shared\Domain\Enum\Unit;

use App\Shared\Domain\Traits\EnumUtilities;

enum UnitUtilityServiceType: string
{
    use EnumUtilities;
    case ELECTRICITY  = "electricity";
    case WATER = "water";
    case GAS = "gas";
    public static function labels(): array
    {
        return [
            self::ELECTRICITY->value => 'كهرباء',
            self::WATER->value => 'ماء',
            self::GAS->value => 'غاز',
        ];
    }
}
