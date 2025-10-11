<?php
declare (strict_types=1);
namespace App\Features\UnitUtilityServices\Application\Outputs;

use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Infrastructure\Models\Estate\Estate;

interface CreateUnitUtilityServiceOutput {
    public function onSuccess (UnitEntity $unitEntity):void;
    public function onNotFound():void;
    public function onFailure(string $error):void;

}