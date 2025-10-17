<?php
declare(strict_types=1);
namespace App\Features\Renters\Application\Contracts;

use App\Features\Renters\Application\Outputs\ShowRentersPaginateOutput;

interface ShowPaginateRenterContract {
    public function execute( ShowRentersPaginateOutput $presenter, int $perPage=5): void;
}