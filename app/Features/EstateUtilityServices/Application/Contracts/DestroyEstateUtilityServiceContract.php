<?php
declare(strict_types=1);
namespace App\Features\EstateUtilityServices\Application\Contracts;

use App\Features\EstateUtilityServices\Application\Outputs\DestroyEstateUtilityServiceOutput;

interface DestroyEstateUtilityServiceContract {
    public function execute(int $EstateUtilityServiceId, DestroyEstateUtilityServiceOutput $presenter): void;
}
