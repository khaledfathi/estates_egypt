<?php
declare (strict_types= 1);
namespace App\Features\Units\Application\Contracts;

use App\Features\Units\Application\Ouputs\UpdateUnitOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;

interface UpdateUnitContract
{
    public function execute (UnitEntity $unitEntity, UpdateUnitOutput $presenter): void;
}