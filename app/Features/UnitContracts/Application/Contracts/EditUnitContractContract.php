<?php
declare (strict_types=1);

namespace App\Features\UnitContracts\Application\Contracts;

use App\Features\UnitContracts\Application\Ouputs\EditUnitContractOutput;

interface  EditUnitContractContract{
    public function execute(int $unitContractId, EditUnitContractOutput $presenter):void;
}