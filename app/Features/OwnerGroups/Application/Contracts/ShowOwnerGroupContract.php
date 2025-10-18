<?php
declare(strict_types=1);
namespace App\Features\OwnerGroups\Application\Contracts; 

use App\Features\OwnerGroups\Application\Outputs\ShowOwnerGroupOutput;
use App\Features\OwnerGroups\Application\Outputs\ShowOwnerGroupsPaginationOutput;

interface ShowOwnerGroupContract {
    public function execute (int $ownerGroupId , ShowOwnerGroupOutput $presneter);
}