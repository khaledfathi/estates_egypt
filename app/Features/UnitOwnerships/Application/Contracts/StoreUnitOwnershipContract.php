<?php

declare(strict_types=1);

namespace App\Features\UnitOwnerships\Application\Contracts;

use App\Features\UnitOwnerships\Application\Outputs\CreateUnitOwnershipOutput;
use App\Features\UnitOwnerships\Application\Outputs\StoreUnitOwnershipOutput;
use App\Shared\Domain\Entities\Unit\UnitOwnershipEntity;

interface StoreUnitOwnershipContract
{
    public function create(int $unitId , CreateUnitOwnershipOutput $presnter): void;
    public function store (UnitOwnershipEntity $unitOwnershipEntity, StoreUnitOwnershipOutput $presnter): void;
}
