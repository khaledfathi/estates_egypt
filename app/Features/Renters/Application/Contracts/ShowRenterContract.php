<?php

declare(strict_types=1);

namespace App\Features\Renters\Application\Contracts;

use App\Features\Renters\Application\Outputs\ShowRenterOutput;

interface ShowRenterContract
{
    public function execute(int $renterId, ShowRenterOutput $presenter): void;
}
