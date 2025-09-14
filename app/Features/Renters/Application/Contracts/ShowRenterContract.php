<?php
declare(strict_types= 1);

namespace App\Features\Renters\Application\Contracts;

use App\Features\Renters\Application\Outputs\ShowRenterOutput;
use App\Features\Renters\Application\Outputs\ShowRentersPaginateOutput;

interface ShowRenterContract {

    public function allWithPaginate( ShowRentersPaginateOutput $presenter, int $perPage=5): void;

    public function showById (int $renterId, ShowRenterOutput $presenter):void;
}