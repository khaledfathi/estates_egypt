<?php
declare (strict_types=1);

namespace App\Features\UnitContracts\Application\Contracts;

use App\Features\UnitContracts\Application\Ouputs\ShowUnitContractOutput;

interface ShowUnitContractContract{
    public function execute(int $UnitContractId , ShowUnitContractOutput $presenter):void;
}