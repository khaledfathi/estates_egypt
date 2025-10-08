<?php
declare (strict_types=1);
namespace App\Features\EstateUtilityServices\Application\Contracts;

use App\Features\EstateUtilityServices\Application\Outputs\ShowAllEstateUtilityServicesOutputs;
use App\Features\EstateUtilityServices\Application\Outputs\ShowEstateUtilityServiceOutput;

interface ShowEstateUtilityServiceContract {
    public function all(int $estateId, ShowAllEstateUtilityServicesOutputs $presenter):void;
    public function showById(int $estateUtilitServiceId , ShowEstateUtilityServiceOutput $presenter):void;
}