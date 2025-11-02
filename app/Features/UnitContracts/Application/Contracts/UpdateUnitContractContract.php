<?php
declare (strict_types=1);

namespace App\Features\UnitContracts\Application\Contracts;

use App\Features\UnitContracts\Application\Ouputs\UpdateUnitContractOutput;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;

interface  UpdateUnitContractContract{
    public function execute(UnitContractEntity $unitContractEntity, UpdateUnitContractOutput $presenter):void;
}