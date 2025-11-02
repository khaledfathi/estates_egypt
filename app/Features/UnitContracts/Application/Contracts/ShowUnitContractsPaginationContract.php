<?php
declare (strict_types=1);

namespace App\Features\UnitContracts\Application\Contracts;

use App\Features\UnitContracts\Application\Ouputs\ShowUnitContractsPaginationOutput;

interface ShowUnitContractsPaginationContract {
    public function execute(int $unitId , ShowUnitContractsPaginationOutput $presenter , $perPage=10):void;
}