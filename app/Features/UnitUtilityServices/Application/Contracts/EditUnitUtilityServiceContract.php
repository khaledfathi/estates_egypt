<?php

declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Application\Contracts;

use App\Features\UnitUtilityServices\Application\Outputs\EditUnitUtilityServiceOutput;

interface EditUnitUtilityServiceContract
{
    public function execute(int $unitUtilityServiceId, EditUnitUtilityServiceOutput $presenter): void;
}
