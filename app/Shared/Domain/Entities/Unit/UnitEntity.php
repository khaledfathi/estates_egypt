<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entities\Unit;

use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Owner\OwnerEntity;
use App\Shared\Domain\Enum\Unit\UnitType;

final class UnitEntity
{
    /**
     * 
     * @param ?int $id
     * @param ?int $estateId
     * @param ?int $number
     * @param ?int $floorNumber
     * @param ?UnitType $type
     * @param ?array<UnitUtilityServiceEntity> $utilityServices
     * @param ?bool $isEmpty
     * @param ?EstateEntity $estate
     * @param ?array<OwnerEntity> $owners
     * @param ?int $ownershipId  the id of realeationship between (unit and owenr) in table ownerships
     */
    public function __construct(
        public ?int $id = null,
        public ?int $estateId = null,
        public ?int  $number = null,
        public ?int  $floorNumber = null,
        public ?UnitType $type = null,
        public ?array $utilityServices = null,
        public ?bool $isEmpty = null,
        public ?EstateEntity $estate = null,
        public ?array $owners = null,
        public ?int $ownershipId = null,
    ) {}
}
