<?php
declare (strict_types=1);
namespace App\Features\EstateUtilityServices\Application\Outputs;

use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceEntity;

interface ShowAllEstateUtilityServicesOutputs {
    /**
     * 
     * @param array<EstateUtilityServiceEntity> $estateUtilityServices
     * @return void
     */
    public function onSuccess(EstateEntity $estateEntity , array $estateUtilityServicesEntities):void;
    public function onNotFound():void;
    public function onFailure(string $error):void;

}