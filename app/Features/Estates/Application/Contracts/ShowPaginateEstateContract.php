<?php
declare (strict_types=1);
namespace App\Features\Estates\Application\Contracts;

use App\Features\Estates\Application\Outputs\ShowEstatesPaginateOutput;

interface ShowPaginateEstateContract {
    public function execute(ShowEstatesPaginateOutput $presenter, int $perPage=5): void;
}