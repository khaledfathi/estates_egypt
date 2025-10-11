<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entities\Unit;

use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Enum\Unit\UnitUtilityServiceType;

final class UnitUtilityServiceEntity
{
    public function __construct(
        public ?int $id = null,
        public ?int $unitId = null,
        public ?UnitUtilityServiceType $type = null,
        public ?string $ownerName = null,
        public ?string $counterNumber = null,
        public ?string $electronicPaymentNumber = null,
        public ?string $notes = null,
        public ?UnitEntity $unit= null,
        public ?EstateEntity $estate=null,
    ) {}
}
