<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Models\OwnerGroup;
use App\Shared\Domain\Entities\Owner\OwnerInGroupEntity;
use App\Shared\Domain\Repositories\OwnerInGroupRepository;
use App\Shared\Infrastructure\Models\Owner\OwnerInGroup;

class EloquentOwnerInGroupRepository implements OwnerInGroupRepository
{

    public function store(OwnerInGroupEntity $ownerInGroupEntity): OwnerInGroupEntity
    {
        $record = OwnerInGroup::create([
            'owner_id' => $ownerInGroupEntity->ownerId,
            'group_id' => $ownerInGroupEntity->groupId,
        ]);
        $ownerInGroupEntity->id = $record->id;
        return $ownerInGroupEntity;
    }
    /**
     * @inheritDoc
     */
    public function storeManyGroups(int $ownerId, array $groupsIds): array
    {
        $OwnerInGroupEntities = [];
        foreach ($groupsIds as $groupId) {
            $record = OwnerInGroup::create([
                'owner_id' => $ownerId,
                'group_id' => $groupId,
            ]);
            $OwnerInGroupEntities[] = new OwnerInGroupEntity(
                $record->id,
                $record->owner_id,
                $record->group_id
            );
        }
        return $OwnerInGroupEntities;
    }
    public function destroy(int $ownerInGroupId): bool
    {
        return OwnerInGroup::find($ownerInGroupId)->delete();
    }
    public function destroyWhereOwnerId(int $ownerId): bool{
        return OwnerInGroup::where('owner_id', $ownerId)->delete() ? true : false ;
    }
}
