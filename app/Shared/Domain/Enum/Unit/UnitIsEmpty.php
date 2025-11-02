<?php

declare(strict_types=1);

namespace App\Shared\Domain\Enum\Unit;

use App\Shared\Domain\Traits\EnumUtilities;

/**
 * CAUTION :
 * the real value used in infrastructures is boolean not int,
 * php dosent support boolean enum !
 */
enum UnitIsEmpty: int 
{
	use EnumUtilities;
	case EMPTY = 1; // equal to false
	case NOT_EMPTY= 0; // equal to true
	/**
	 * 
	 * @inheritDoc
	 */
	public static function labels(): array
	{
		return [
			self::EMPTY->value => 'فارغة',
			self::NOT_EMPTY->value => 'مشغولة',
		];
	}
}
