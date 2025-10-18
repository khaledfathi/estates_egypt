<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServices\Application\Contracts;

use App\Features\EstateUtilityServices\Application\Outputs\UpdateEstateUtilityServiceOutput;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceEntity;

interface UpdateEstateUtilityServiceContract 
{
    public function execute(EstateUtilityServiceEntity $estateUtilityServiceEntity, UpdateEstateUtilityServiceOutput $presenter): void;
}
