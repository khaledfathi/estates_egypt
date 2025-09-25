<?php

declare(strict_types=1);

namespace App\Shared\Domain\Enum\Unit;

use App\Shared\Domain\Traits\EnumUtilities;

enum UnitType: string
{

	use EnumUtilities;
	case RESDENTIAL = 'residential';
	case COMMERCIAL = 'commercial';
	/**
	 * 
	 * @inheritDoc
	 */
	public static function labels(): array
	{
		return [
			self::RESDENTIAL->value => 'سكنى',
			self::COMMERCIAL->value => 'تجارى',
		];
	}
}
