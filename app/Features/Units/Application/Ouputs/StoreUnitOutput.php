<?php
declare (strict_types= 1);

namespace App\Features\Units\Application\Ouputs;

use App\Shared\Domain\Entities\Unit\UnitEntity;

interface StoreUnitOutput {
    public function onSuccess (UnitEntity $unitEntity):void ;
    public function onFailure (string $error):void ;
}