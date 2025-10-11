<?php
declare (strict_types=1);
namespace App\Features\UnitUtilityServices\Application\Outputs;

use App\Shared\Domain\Entities\Unit\UnitUtilityServiceEntity;

interface EditUnitUtilityServiceOutput {
    public function onSuccess(UnitUtilityServiceEntity $unitUtilityServiceEntity):void;
    public function onNotFound():void;
    public function onFailure(string $error):void;
}