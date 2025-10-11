<?php
declare (strict_types=1);
namespace App\Features\UnitUtilityServices\Application\Contracts;

use App\Features\UnitUtilityServices\Application\Outputs\ShowAllUnitUtilityServicesOutput;
use App\Features\UnitUtilityServices\Application\Outputs\ShowUnitUtilityServiceOutput;

interface ShowUnitUtilityServiceContract {

    public function all(int $unitId, ShowAllUnitUtilityServicesOutput $presenter):void;
    public function showById(int $unitUtilitServiceId , ShowUnitUtilityServiceOutput $presenter):void;
}