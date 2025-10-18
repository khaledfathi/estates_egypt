<?php
declare(strict_types=1);
namespace App\Features\Renters\Application\Contracts;

use App\Features\Renters\Application\Outputs\ShowRentersPaginationOutput;

interface ShowRentersPaginationContract {
    public function execute( ShowRentersPaginationOutput $presenter, int $perPage=5): void;
}