<?php
declare (strict_types=1);
namespace App\Features\EstateUtilityServices\Application\Contracts;

use App\Features\EstateUtilityServices\Application\Outputs\ShowAllEstateUtilityServicesOutputs;

interface ShowAllEstateUtilityServicesContract {
    public function execute(int $estateId, ShowAllEstateUtilityServicesOutputs $presenter):void;
}