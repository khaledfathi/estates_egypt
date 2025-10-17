<?php

declare(strict_types=1);

namespace App\Features\Units\Application\Contracts;

use App\Features\Units\Application\Ouputs\EditUnitOutput;

interface EditUnitContract
{
    public function execute(int $unitId, EditUnitOutput $presenter): void;
}
