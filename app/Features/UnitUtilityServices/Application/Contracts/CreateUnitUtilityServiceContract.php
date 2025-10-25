<?php
declare(strict_types=1);
namespace App\Features\UnitUtilityServices\Application\Contracts;

use App\Features\UnitUtilityServices\Application\Outputs\CreateUnitUtilityServiceOutput;

interface CreateUnitUtilityServiceContract{
    public function execute(int $unitId , CreateUnitUtilityServiceOutput $presenter):void;
}