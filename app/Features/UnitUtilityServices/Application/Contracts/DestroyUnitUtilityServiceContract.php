<?php
declare (strict_types=1);
namespace App\Features\UnitUtilityServices\Application\Contracts;

use App\Features\UnitUtilityServices\Application\Outputs\DestroyUnitUtilityServiceOutput;

interface DestroyUnitUtilityServiceContract {
    public function execute(int $unitUtilityServiceId,  DestroyUnitUtilityServiceOutput $presenter):void;
}
