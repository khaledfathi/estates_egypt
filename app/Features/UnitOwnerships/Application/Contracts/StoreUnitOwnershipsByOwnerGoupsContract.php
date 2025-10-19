<?php

declare(strict_types=1);

namespace App\Features\UnitOwnerships\Application\Contracts;

use App\Features\UnitOwnerships\Application\DTOs\OwnershipByOwnersGroupsDTO;
use App\Features\UnitOwnerships\Application\Outputs\StoreUnitOwnershipsOutput;
use App\Shared\Domain\Entities\Unit\UnitOwnershipEntity;

interface StoreUnitOwnershipsByOwnerGoupsContract 
{
    /**
     * 
     * @param array<UnitOwnershipEntity> $unitOwnershipEntity
     * @param StoreUnitOwnershipsOutput $presnter
     * @return void
     */
    public function execute (OwnershipByOwnersGroupsDTO $ownershipByOwnersGroupsDTO, StoreUnitOwnershipsOutput $presnter): void;
}
