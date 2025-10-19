<?php

declare(strict_types=1);

namespace App\Features\Owners\Application\Contracts;

use App\Features\Owners\Application\Outputs\ShowOwnersPaginationOutput;

interface ShowOwnersPaginationContract
{
    public function execute(ShowOwnersPaginationOutput $presenter, int $perPage = 5): void;
}
