<?php
declare (strict_types=1);
namespace App\Features\EstateUtilityServices\Application\Contracts;

use App\Features\EstateUtilityServices\Application\Outputs\ShowEstateUtilityServiceOutput;

interface ShowEstateUtilityServiceContract {
    public function execute(int $estateUtilitServiceId , int $invoicesYear ,ShowEstateUtilityServiceOutput $presenter):void;
}