<?php
declare(strict_types=1);
namespace App\Features\OwnerGroups\Application\Contracts; 

use App\Features\OwnerGroups\Application\Outputs\ShowOwnerGroupOutput;
use App\Features\OwnerGroups\Application\Outputs\ShowOwnerGroupsPaginateOutput;

interface ShowOwnerGroupContract {
    public function allWithPaginate(ShowOwnerGroupsPaginateOutput $presenter, int $perPage = 5);
    public function  showById (int $ownerGroupId , ShowOwnerGroupOutput $presneter);
}