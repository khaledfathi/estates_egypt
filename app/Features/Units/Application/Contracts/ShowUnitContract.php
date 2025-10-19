<?php
declare(strict_types= 1);

namespace App\Features\Units\Application\Contracts; 

use App\Features\Units\Application\Ouputs\ShowUnitOutput;

interface ShowUnitContract {


    public function execute(int $unitId, ShowUnitOutput $presenter):void;
}