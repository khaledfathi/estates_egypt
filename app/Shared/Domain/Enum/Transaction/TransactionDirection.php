<?php

declare(strict_types=1);

namespace App\Shared\Domain\Enum\Transaction; 

use App\Shared\Domain\Traits\EnumUtilities;

enum TransactionDirection: string
{
    use EnumUtilities;
    case WITHDRAW = 'withdraw';
    case DEPOSIT = 'deposit';

    /**
     * 
     * @inheritDoc
     */
    public static function labels(): array
    {
        return [
            self::WITHDRAW->value => 'سحب',
            self::DEPOSIT->value => 'ايداع',
        ];
    }
}
