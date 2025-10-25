<?php
declare (strict_types= 1);

namespace App\Features\Units\Application\Contracts; 

use App\Features\Units\Application\Ouputs\DestroyUnitOutput;

interface DestroyUnitContract {
    public function execute(int $unitId, DestroyUnitOutput $presenter): void;

}