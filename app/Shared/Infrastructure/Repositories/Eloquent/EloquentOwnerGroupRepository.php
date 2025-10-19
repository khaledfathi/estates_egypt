<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Features\OwnerGroups\Domain\ValueObjects\OwnerGroupEntitiesWithPagination;
use App\Models\OwnerGroup;
use App\Shared\Domain\Entities\Owner\OwnerEntity;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Domain\Entities\Owner\OwnerInGroupEntity;
use App\Shared\Domain\Repositories\OwnerGroupRepository;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Domain\ValueObjects\Pagination;
use App\Shared\Infrastructure\Models\Owner\Owner;
use App\Shared\Infrastructure\Models\Owner\OwnerInGroup;
use Exception;

final class EloquentOwnerGroupRepository implements OwnerGroupRepository
{
    /**
     * 
     * @inheritDoc
     */
    public function index(): array
    {
        //Query 
        $ownerGroupsRecords = OwnerGroup::orderBy('name')->get();
        $arrayOfOwnerGroups = [];
        foreach ($ownerGroupsRecords as $record) {
            $arrayOfOwnerGroups[] = new OwnerGroupEntity(
                $record->id,
                $record->name,
            );
        }
        return $arrayOfOwnerGroups;
    }
    public function indexWithPaginate(int $perPage): EntitiesWithPagination
    {
        //Query 
        $ownerGroupsRecords = OwnerGroup::withCount('ownerInGroups')->orderBy('created_at', 'desc')
            ->paginate($perPage);
        //Transform to DTO
        $arrayOfOwnerGroups = [];
        foreach ($ownerGroupsRecords as $record) {
            //ownerGroup DTO
            $arrayOfOwnerGroups[] = new OwnerGroupEntity(
                (int) $record->id,
                $record->name,
                $record->owner_in_groups_count
            );
        }
        //Pagination DTO
        $paginationData = new Pagination(
            perPage: $ownerGroupsRecords->perPage(),
            currentPage: $ownerGroupsRecords->currentPage(),
            path: $ownerGroupsRecords->path(),
            pageName: $ownerGroupsRecords->getPageName(),
            total: $ownerGroupsRecords->total()
        );
        //Final DTO
        return  new OwnerGroupEntitiesWithPagination(
            $paginationData,
            $arrayOfOwnerGroups
        );
    }
    public function show(int $OwnerGroupId): OwnerGroupEntity|null
    {
        $record = OwnerGroup::with('ownerInGroups', 'ownerInGroups.owner')->withCount('ownerInGroups')->find($OwnerGroupId);
        if ($record) {
            //Owner DTO 
            $owners = [];
            foreach ($record->ownerInGroups as $ownerInGroup) {
                $owners[] = new OwnerEntity(
                    id: $ownerInGroup->owner->id,
                    name: $ownerInGroup->owner->name,
                    nationalId: $ownerInGroup->owner->national_id,
                    phones: $ownerInGroup->owner->phones->pluck('phone')->toArray(),
                    ownerInGroup: new OwnerInGroupEntity(
                        $ownerInGroup->id,
                        $ownerInGroup->owner_id,
                        $ownerInGroup->group_id,
                    ),

                );
            }
            //OwnerGroup DTO
            $ownerGroupEntity  = new OwnerGroupEntity(
                $record->id,
                $record->name,
                $record->owner_in_groups_count,
                $owners,
            );
            return $ownerGroupEntity;
        }
        return null;
    }
    public function getOwnersIds(array $OwnerGroupsIds): array
    {
        $ownersIds = [];
        $records = OwnerGroup::with('ownerInGroups')->whereIn('id', $OwnerGroupsIds)->get();
        foreach ($records as $record) {
            foreach($record->ownerInGroups as $ownerInGroup){
                $ownersIds[] = $ownerInGroup->owner_id;
            }
        }
        return $ownersIds;
    }
    public function store(OwnerGroupEntity $ownerGroupEntity): OwnerGroupEntity
    {
        $record = OwnerGroup::create([
            'name' => $ownerGroupEntity->name,
        ]);
        $ownerGroupEntity->id = $record->id;
        return $ownerGroupEntity;
    }
    public function update(OwnerGroupEntity $ownerGroupEntity): bool
    {
        return OwnerGroup::find($ownerGroupEntity->id)->update([
            'name' => $ownerGroupEntity->name,
        ]);
    }
    public function destroy(int $OwnerGroupId): bool
    {
        return OwnerGroup::find($OwnerGroupId)->delete();
    }
}
