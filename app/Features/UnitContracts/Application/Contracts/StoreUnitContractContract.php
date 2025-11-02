<?php
declare (strict_types=1);

namespace App\Features\UnitContracts\Application\Contracts;

use App\Features\UnitContracts\Application\Ouputs\StoreUnitContractOutput;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;

interface StoreUnitContractContract{
    public function execute(UnitContractEntity $unitContractEntity, StoreUnitContractOutput $presenter):void;
}