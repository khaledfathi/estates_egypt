<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entities\Unit;

use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Enum\Unit\UnitOwnershipType;
use App\Shared\Domain\Enum\Unit\UnitType;

final class UnitEntity
{
    public function __construct(
        public ?int $id = null,
        public ?int $estateId = null,
        public ?int  $number = null,
        public ?int  $floorNumber = null,
        public ?UnitType $type = null, 
        public ?UnitOwnershipType $ownershipType = null, 
        public ?array $utilityServices = null, 
        public ?bool $isEmpty = null,
        public ?EstateEntity $estate= null,
    ) {}
}
