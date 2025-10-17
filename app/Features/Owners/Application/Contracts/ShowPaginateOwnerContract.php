<?php

declare(strict_types=1);

namespace App\Features\Owners\Application\Contracts;

use App\Features\Owners\Application\Outputs\ShowOwnersPaginateOutput;

interface ShowPaginateOwnerContract
{
    public function execute(ShowOwnersPaginateOutput $presenter, int $perPage = 5): void;
}
