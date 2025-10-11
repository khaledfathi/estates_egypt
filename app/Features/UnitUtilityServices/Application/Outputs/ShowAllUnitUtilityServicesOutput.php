<?php
declare (strict_types=1);

namespace App\Features\UnitUtilityServices\Application\Outputs;

use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\Entities\Unit\UnitUtilityServiceEntity;

interface  ShowAllUnitUtilityServicesOutput{
    /**
     * 
     * @param array<UnitUtilityServiceEntity> $unitUtilityServices
     * @return void
     */
    public function onSuccess(  UnitEntity $unit , array $unitUtilityServicesEntities):void;
    public function onNotFound():void;
    public function onFailure(string $error):void;
}