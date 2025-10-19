<?php
declare (strict_types=1);
namespace App\Shared\Domain\Repositories; 

use App\Shared\Domain\Entities\Owner\OwnerInGroupEntity;
use App\Shared\Infrastructure\Models\Owner\OwnerInGroup;

interface OwnerInGroupRepository {

    public function store(OwnerInGroupEntity $ownerInGroupEntity):OwnerInGroupEntity;
    /**
     * @param int $ownerId
     * @param array<int> $groupsIds
     * @return array<OwnerInGroup> 
     */
    public function storeManyGroups(int $ownerId, array $groupsIds): array;
    public function destroy (int $ownerInGroupId):bool;
    public function destroyWhereOwnerId(int $ownerId): bool;
}