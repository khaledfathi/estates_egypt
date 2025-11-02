<?php
declare (strict_types=1);

namespace App\Features\UnitContracts\Application\Ouputs;

use App\Shared\Domain\Entities\Renter\RenterEntity;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;

interface EditUnitContractOutput{
    /**
     * @param \App\Shared\Domain\Entities\Unit\UnitContractEntity $unitContractEntity
     * @param array $renterEntities
     * @return array<RenterEntity> 
     */
    public function onSuccess(UnitContractEntity $unitContractEntity, array $renterEntities):void;
    public function onNotfound():void;
    public function onFailure(string $error):void;
}