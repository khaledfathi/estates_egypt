<?php

declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Application\Contracts;

use App\Features\UnitUtilityServices\Application\Outputs\EditUnitUtilityServiceOutput;
use App\Features\UnitUtilityServices\Application\Outputs\UpdateUnitUtilityServiceOutput;
use App\Shared\Domain\Entities\Unit\UnitUtilityServiceEntity;

interface  UpdateUnitUtilityServiceContract
{
    public function edit(int $unitUtilityServiceId, EditUnitUtilityServiceOutput $presenter): void;
    public function update(UnitUtilityServiceEntity $unitUtilityServiceEntity, UpdateUnitUtilityServiceOutput $presenter): void;
}
