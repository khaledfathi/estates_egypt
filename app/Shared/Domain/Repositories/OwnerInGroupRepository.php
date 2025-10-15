<?php
declare (strict_types=1);
namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Domain\Entities\Owner\OwnerInGroupEntity;

interface OwnerInGroupRepository {

    public function store(OwnerInGroupEntity $ownerInGroupEntity):OwnerGroupEntity;
    public function destroy (int $ownerInGroupId):bool;
}