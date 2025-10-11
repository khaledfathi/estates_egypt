<?php
declare (strict_types=1);

namespace App\Features\UnitUtilityServices\Application\Outputs;

use App\Shared\Domain\Entities\Unit\UnitUtilityServiceEntity;

interface StoreUnitUtilityServiceOutput {
    public function onSuccess(UnitUtilityServiceEntity $unitUtilityServiceEntity):void;
    public function onFailure(string $error):void;
}