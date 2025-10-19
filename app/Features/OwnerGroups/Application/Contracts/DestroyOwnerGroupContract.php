<?php
declare (strict_types=1);
namespace App\Features\OwnerGroups\Application\Contracts;

use App\Features\OwnerGroups\Application\Outputs\DestroyOwnerGroupOutput;

interface DestroyOwnerGroupContract {
    public function execute(int $ownerGroupId , DestroyOwnerGroupOutput $presneter):void;
}