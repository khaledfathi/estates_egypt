<?php
declare (strict_types=1);

namespace App\Features\UnitUtilityServices\Application\Contracts;

use App\Features\UnitUtilityServices\Application\Outputs\CreateUnitUtilityServiceOutput;
use App\Features\UnitUtilityServices\Application\Outputs\StoreUnitUtilityServiceOutput;
use App\Shared\Domain\Entities\Unit\UnitUtilityServiceEntity;

interface StoreUnitUtilityServiceContract {
    public function create(int $unitId , CreateUnitUtilityServiceOutput $presenter):void;
    public function store (UnitUtilityServiceEntity $unitUtilityServiceEntity , StoreUnitUtilityServiceOutput $presenter):void;
}