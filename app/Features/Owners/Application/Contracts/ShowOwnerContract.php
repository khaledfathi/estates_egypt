<?php
declare(strict_types=1);

namespace App\Features\Owners\Application\Contracts;

use App\Features\Owners\Application\Outputs\ShowOwnerOutput;
use App\Features\Owners\Application\Outputs\ShowOwnersPaginateOutput;

interface ShowOwnerContract
{
    public function allWithPaginate(ShowOwnersPaginateOutput $presenter, int $perPage=5): void;

    public function showById (int $id , ShowOwnerOutput $presenter):void;
}
