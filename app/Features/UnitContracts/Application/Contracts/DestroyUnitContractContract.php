<?php
declare (strict_types=1);

namespace App\Features\UnitContracts\Application\Contracts;

use App\Features\UnitContracts\Application\Ouputs\DestroyUnitContractOutput;

interface DestroyUnitContractContract{
    public function execute(int $UnitContractId , DestroyUnitContractOutput $presenter):void;
}