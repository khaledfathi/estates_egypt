<?php

declare(strict_types=1);

namespace App\Features\OwnerGroups\Application\Contracts;

use App\Features\OwnerGroups\Application\Outputs\EditOwnerGroupsOutput;

interface EditOwnerGroupContract
{
    public function execute(int $ownerGroupId, EditOwnerGroupsOutput $presneter): void;
}
