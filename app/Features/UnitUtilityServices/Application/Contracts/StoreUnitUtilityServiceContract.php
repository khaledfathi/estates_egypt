<?php
declare (strict_types=1);

namespace App\Features\UnitUtilityServices\Application\Contracts;

use App\Features\UnitUtilityServices\Application\Outputs\StoreUnitUtilityServiceOutput;
use App\Shared\Domain\Entities\Unit\UnitUtilityServiceEntity;

interface StoreUnitUtilityServiceContract {
    public function execute (UnitUtilityServiceEntity $unitUtilityServiceEntity , StoreUnitUtilityServiceOutput $presenter):void;
}