<?php
declare(strict_types=1);
namespace App\Features\UnitUtilityServices\Application\Contracts;

use App\Features\UnitUtilityServices\Application\Outputs\ShowAllUnitUtilityServicesOutput;

interface ShowAllUnitUtilityServiceContract {
    public function execute(int $unitId, ShowAllUnitUtilityServicesOutput $presenter):void;
}