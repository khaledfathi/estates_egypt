<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entities\Unit;

use App\Shared\Domain\Enum\Unit\UnitUtilityServiceType;

final class UnitUtilityService
{
    public function __construct(
        public ?int $id = null,
        public ?int $unitId = null,
        public ?UnitUtilityServiceType $type = null,
        public ?string $ownerName = null,
        public ?string $counterNumbr = null,
        public ?string $electronicPaymentNumbe = null,
        public ?string $note = null,
    ) {}
}
