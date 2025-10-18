<?php
declare (strict_types=1);
namespace App\Features\Estates\Application\Contracts;

use App\Features\Estates\Application\Outputs\ShowEstatesPaginationOutput;

interface ShowEstatesPaginationContract {
    public function execute(ShowEstatesPaginationOutput $presenter, int $perPage=5): void;
}