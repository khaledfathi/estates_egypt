<?php
declare(strict_types=1);
namespace App\Features\EstateUtilityServices\Application\Outputs;

use App\Shared\Domain\Entities\Estate\EstateEntity;

interface CreateEstateUtilityServiceOutput{
    /**
     * 
     * @param EstateEntity $estateEntity
     * @param array $utilityServiceTypes (value=>label) for utility service types  used in ENUM (App\Shared\Domain\Enum\Renter\EstateUtilityServiceType) 
     * @return void
     */
    public function onSuccess(EstateEntity $estateEntity, array $utilityServiceTypes);
    public function onEstateNotFound();
    public function onFailure (string $error);
}
