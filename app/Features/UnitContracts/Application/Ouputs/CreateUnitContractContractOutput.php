<?php
declare (strict_types=1);

namespace App\Features\UnitContracts\Application\Ouputs;

use App\Shared\Domain\Entities\Renter\RenterEntity;
use App\Shared\Domain\Entities\Unit\UnitEntity;

interface CreateUnitContractContractOutput {
    /**
     * @param array<RenterEntity> $renterEntities
     * @param UnitEntity $unitEntity 
     * @return void
     */
    public function onSuccess(UnitEntity $unitEntity , array $renterEntities ):void;
    public function onUnitNotFound():void;
    public function onFailure(string $error):void;
}