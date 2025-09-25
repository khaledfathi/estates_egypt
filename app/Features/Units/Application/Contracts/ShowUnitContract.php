<?php
declare(strict_types= 1);

namespace App\Features\Units\Application\Contracts; 

use App\Features\Units\Application\Ouputs\ShowUnitOutput;
use App\Features\Units\Application\Ouputs\ShowUnitPaginateOutput;

interface ShowUnitContract {

    public function allWithPaginate( ShowUnitPaginateOutput $presenter, int $estateId , int $perPage=5): void;

    public function showById (int $unitId, ShowUnitOutput $presenter):void;
}