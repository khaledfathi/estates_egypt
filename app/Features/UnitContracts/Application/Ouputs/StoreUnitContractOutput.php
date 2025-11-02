<?php
declare (strict_types=1);

namespace App\Features\UnitContracts\Application\Ouputs;

use App\Shared\Domain\Entities\Unit\UnitContractEntity;

interface StoreUnitContractOutput{
    public function onSuccess(UnitContractEntity $unitContractEntity):void;
    public function onFailure(string $error):void;
}