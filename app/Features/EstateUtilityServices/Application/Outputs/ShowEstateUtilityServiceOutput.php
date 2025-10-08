<?php
declare(strict_types=1);
namespace App\Features\EstateUtilityServices\Application\Outputs;

use App\Shared\Domain\Entities\Estate\EstateUtilityServiceEntity;

interface ShowEstateUtilityServiceOutput {
    public function onSuccess(EstateUtilityServiceEntity $estateUtilityServiceEntity):void;
    public function onNotFound():void;
    public function onFailure(string $error):void;
}