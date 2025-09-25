<?php

declare(strict_types=1);

namespace App\Shared\Domain\Enum\Renter;

use App\Shared\Domain\Traits\EnumUtilities;

enum RenterIdentityType: string
{
    use EnumUtilities;
    case NATIONAL_ID = 'national_id';
    case PASSPORT = 'passport';

    /**
     * 
     * @inheritDoc
     */
    public static function labels(): array
    {
        return [
            self::NATIONAL_ID->value => 'رقم قومى',
            self::PASSPORT->value => 'باسبور',
        ];
    }
}
