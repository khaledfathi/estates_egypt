<?php
declare (strict_types=1);
namespace App\Features\EstateUtilityServices\Application\Outputs;

use App\Shared\Domain\Entities\Estate\EstateUtilityServiceEntity;

interface StoreEstateUtilityServiceOutput {
    public function onSuccess(EstateUtilityServiceEntity $estateUtilityServiceEntity);
    public function onFailure(string $error);
}