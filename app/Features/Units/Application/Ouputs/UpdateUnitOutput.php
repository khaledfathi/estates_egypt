<?php
declare (strict_types= 1);

namespace App\Features\Units\Application\Ouputs;

use App\Shared\Domain\Entities\Unit\UnitEntity;

interface UpdateUnitOutput
{
    public function onSuccess(bool $status , UnitEntity $unitEntity): void;
    public function onFailure($error):void;
} 