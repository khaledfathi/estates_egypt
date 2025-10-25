<?php

declare(strict_types=1);

namespace App\Features\UnitOwnerships\Application\Contracts;

use App\Features\UnitOwnerships\Application\Outputs\CreateUnitOwnershipOutput;

interface CreateUnitOwnershipContract
{
    public function execute(int $unitId, CreateUnitOwnershipOutput $presnter): void;
}
