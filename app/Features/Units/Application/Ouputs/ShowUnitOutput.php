<?php
declare (strict_types= 1);

namespace  App\Features\Units\Application\Ouputs;

use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Unit\UnitEntity;

interface ShowUnitOutput {
    public function onSuccess(UnitEntity $unitEntity):void;
    public function onNotFount():void;
    public function onFailure(String $error):void;
}
