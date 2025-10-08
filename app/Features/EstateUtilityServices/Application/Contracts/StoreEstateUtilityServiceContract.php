<?php
declare (strict_types=1);
namespace App\Features\EstateUtilityServices\Application\Contracts;

use App\Features\EstateUtilityServices\Application\Outputs\CreateEstateUtilityServiceOutput;
use App\Features\EstateUtilityServices\Application\Outputs\StoreEstateUtilityServiceOutput;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceEntity;

interface StoreEstateUtilityServiceContract{
    public function create(int $estateId , CreateEstateUtilityServiceOutput $presenter):void;
    public function store(EstateUtilityServiceEntity $estateUtilityServiceEntity,StoreEstateUtilityServiceOutput $presenter):void;
}