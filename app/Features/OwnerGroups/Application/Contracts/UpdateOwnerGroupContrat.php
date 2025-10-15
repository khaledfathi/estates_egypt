<?php
declare (strict_types=1);

namespace App\Features\OwnerGroups\Application\Contracts;

use App\Features\OwnerGroups\Application\Outputs\EditOwnerGroupsOutput;
use App\Features\OwnerGroups\Application\Outputs\UpdateOwnerGroupOutput;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;

interface UpdateOwnerGroupContrat {
    public function edit(int $ownerGroupId, EditOwnerGroupsOutput $presneter):void;
    public function update(OwnerGroupEntity $ownerGroupEntity, UpdateOwnerGroupOutput $presneter):void;
}