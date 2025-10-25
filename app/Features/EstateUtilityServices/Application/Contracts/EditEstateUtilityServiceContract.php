<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServices\Application\Contracts;

use App\Features\EstateUtilityServices\Application\Outputs\EditEstateUtilityServiceOutput;

interface EditEstateUtilityServiceContract
{
    public function execute(int $estateUtilityServiceId, EditEstateUtilityServiceOutput $presenter): void;
}
