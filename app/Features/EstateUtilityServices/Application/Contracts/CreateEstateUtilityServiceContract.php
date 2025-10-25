<?php
declare(strict_types=1);
namespace App\Features\EstateUtilityServices\Application\Contracts;

use App\Features\EstateUtilityServices\Application\Outputs\CreateEstateUtilityServiceOutput;

interface CreateEstateUtilityServiceContract {
    public function execute(int $estateId , CreateEstateUtilityServiceOutput $presenter):void;
}