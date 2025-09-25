<?php
declare (strict_types= 1);
namespace App\Features\Units\Application\Contracts;

use App\Features\Units\Application\Ouputs\EditUnitOutput;
use App\Features\Units\Application\Ouputs\UpdateUnitOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;

interface UpdateUnitContract
{
    public function edit(int $unitId, EditUnitOutput $presenter): void;
    public function update (UnitEntity $unitEntity, UpdateUnitOutput $presenter): void;
}