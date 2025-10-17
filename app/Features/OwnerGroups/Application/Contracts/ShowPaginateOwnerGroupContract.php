<?php
declare (strict_types=1);
namespace App\Features\OwnerGroups\Application\Contracts;

use App\Features\OwnerGroups\Application\Outputs\ShowOwnerGroupsPaginateOutput;

interface ShowPaginateOwnerGroupContract {
    public function execute (ShowOwnerGroupsPaginateOutput $presenter, int $perPage = 5);
}