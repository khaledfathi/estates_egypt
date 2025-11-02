<?php

declare(strict_types=1);

namespace App\Shared\Domain\Enum\Unit; 

use App\Shared\Domain\Traits\EnumUtilities;

enum UnitContractType: string
{

	use EnumUtilities;
	case OLD_LAW= 'old_law';
	case NEW_LAW = 'new_law';
	/**
	 * 
	 * @inheritDoc
	 */
	public static function labels(): array
	{
		return [
			self::OLD_LAW->value => 'قانون قديم',
			self::NEW_LAW->value => 'قانون جديد',
		];
	}
}
