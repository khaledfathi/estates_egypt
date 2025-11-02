<?php
declare (strict_types=1);

namespace App\Features\UnitContracts\Application\Contracts;

use App\Features\UnitContracts\Application\Ouputs\CreateUnitContractContractOutput;

interface CreateUnitContractContract{
    public function execute(int $UnitId , CreateUnitContractContractOutput $presenter):void;
}