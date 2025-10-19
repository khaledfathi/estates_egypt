<?php

declare(strict_types=1);

namespace App\Features\Units\Application\Contracts;

use App\Features\Units\Application\Ouputs\StoreUnitOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;

interface StoreUnitContract
{
    public function execute(UnitEntity $unitEntity, StoreUnitOutput $presenter):void ;
}
