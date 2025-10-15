<?php
declare (strict_types=1);
namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Domain\Entities\Owner\OwnerInGroupEntity;

class EloquentOwnerInGroupRepository implements OwnerInGroupRepository{

    public function store(OwnerInGroupEntity $ownerInGroupEntity):OwnerGroupEntity{
        return new OwnerGroupEntity();
    }
    public function destroy (int $ownerInGroupId):bool{
        return false; 
    }
}