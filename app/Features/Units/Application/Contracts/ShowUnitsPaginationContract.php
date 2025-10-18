<?php

declare(strict_types=1);

namespace App\Features\Units\Application\Contracts;

use App\Features\Units\Application\Ouputs\ShowUnitsPaginationOutput;

interface ShowUnitsPaginationContract
{
    public function execute(ShowUnitsPaginationOutput $presenter, int $estateId, int $perPage = 5): void;
}
