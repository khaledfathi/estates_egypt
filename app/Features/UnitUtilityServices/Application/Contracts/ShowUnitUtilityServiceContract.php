<?php
declare (strict_types=1);
namespace App\Features\UnitUtilityServices\Application\Contracts;

use App\Features\UnitUtilityServices\Application\Outputs\ShowUnitUtilityServiceOutput;

interface ShowUnitUtilityServiceContract {

    public function execute(int $unitUtilitServiceId , ShowUnitUtilityServiceOutput $presenter):void;
}