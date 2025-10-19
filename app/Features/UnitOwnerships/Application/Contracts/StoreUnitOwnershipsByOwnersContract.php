<?php

declare(strict_types=1);

namespace App\Features\UnitOwnerships\Application\Contracts;

use App\Features\UnitOwnerships\Application\DTOs\OwnershipByOwnersFormDTO;
use App\Features\UnitOwnerships\Application\Outputs\StoreUnitOwnershipsOutput;
use App\Shared\Domain\Entities\Unit\UnitOwnershipEntity;

interface StoreUnitOwnershipsByOwnersContract 
{
    public function execute (OwnershipByOwnersFormDTO $ownershipByOwnersFormDTO, StoreUnitOwnershipsOutput $presnter): void;
}
