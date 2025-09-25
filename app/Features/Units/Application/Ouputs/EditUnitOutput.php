<?php
declare (strict_types= 1);
namespace App\Features\Units\Application\Ouputs;

use App\Features\Units\Application\DTOs\UnitFormDTO;
use App\Shared\Domain\Entities\Unit\UnitEntity;

interface EditUnitOutput 
{
    public function onSuccess(UnitFormDTO $unitFormData , UnitEntity $unitEntity):void;
    public function onNotFound():void;
    public function onFailure($error):void;
}