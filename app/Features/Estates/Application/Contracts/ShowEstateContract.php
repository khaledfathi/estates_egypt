<?php
declare(strict_types=1);

namespace App\Features\Estates\Application\Contracts;

use App\Features\Estates\Application\Outputs\ShowEstateOutput;
use App\Features\Estates\Application\Outputs\ShowEstatesPaginateOutput;

interface ShowEstateContract {

    public function allWithPaginate(ShowEstatesPaginateOutput $presenter, int $perPage=5): void;
    public function showById (int $estateId , ShowEstateOutput $presenter):void;
}