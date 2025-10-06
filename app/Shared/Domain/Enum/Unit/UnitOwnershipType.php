<?php

declare(strict_types=1);

namespace App\Shared\Domain\Enum\Unit;

use App\Shared\Domain\Traits\EnumUtilities;

enum UnitOwnershipType: string
{

    use EnumUtilities;
    case SINGLE = 'single';
    case SHARED = 'shared';

    /**
     * 
     * @inheritDoc
     */
    public static function labels(): array
    {
        return [
            self::SINGLE->value => 'مالك واحد',
            self::SHARED->value => 'متعدد الملاك',
        ];
    }
}
