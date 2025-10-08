<?php

declare(strict_types=1);

namespace App\Shared\Domain\Enum\Estate; 

use App\Shared\Domain\Traits\EnumUtilities;

enum EstateUtilityServiceType: string
{

    use EnumUtilities;
    case WATER= 'water';
    case ELECTRICITY  = 'electricity';

    /**
     * 
     * @inheritDoc
     */
    public static function labels(): array
    {
        return [
            self::WATER->value => 'مياة',
            self::ELECTRICITY->value => 'كهرياء',
        ];
    }
}
