<?php
declare (strict_types=1);
namespace App\Features\OwnerGroups\Application\Contracts;

use App\Features\OwnerGroups\Application\Outputs\ShowOwnerGroupsPaginationOutput;

interface ShowOwnerGroupsPaginationContract {
    public function execute (ShowOwnerGroupsPaginationOutput $presenter, int $perPage = 5);
}