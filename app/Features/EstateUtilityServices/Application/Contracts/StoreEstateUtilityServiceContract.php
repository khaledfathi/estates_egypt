<?php
declare (strict_types=1);
namespace App\Features\EstateUtilityServices\Application\Contracts;

use App\Features\EstateUtilityServices\Application\Outputs\StoreEstateUtilityServiceOutput;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceEntity;

interface StoreEstateUtilityServiceContract{
    public function execute(EstateUtilityServiceEntity $estateUtilityServiceEntity,StoreEstateUtilityServiceOutput $presenter):void;
}