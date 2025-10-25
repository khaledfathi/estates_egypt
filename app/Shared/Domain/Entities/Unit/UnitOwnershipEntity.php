<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entities\Unit;

use App\Shared\Domain\Entities\Owner\OwnerEntity;

final class UnitOwnershipEntity 
{
    public function __construct(
        public ?int $id= null,
        public ?int $unitId = null,
        public ?int $ownerId = null,
        public ?OwnerEntity $owner = null ,
        public ?UnitEntity $unit = null ,
    ) {}
}
