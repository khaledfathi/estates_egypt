<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Features\OwnerGroups\Domain\ValueObjects\OwnerGroupEntitiesWithPagination;
use App\Models\OwnerGroup;
use App\Shared\Domain\Entities\Owner\OwnerEntity;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Domain\Repositories\OwnerGroupRepository;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Domain\ValueObjects\Pagination;

class EloquentOwnerGroupRepository implements OwnerGroupRepository
{
    /**
     * 
     * @inheritDoc
     */
    public function index(): array
    {
        return [];
    }
    public function indexWithPaginate(int $perPage): EntitiesWithPagination
    {
        //Query 
        $ownerGroupsRecords = OwnerGroup::orderBy('created_at', 'desc')->withCount('owners')
            ->paginate($perPage);
        //Transform to DTO
        $arrayOfOwnerGroups = [];
        foreach ($ownerGroupsRecords as $record) {
            //ownerGroup DTO
            $arrayOfOwnerGroups[] = new OwnerGroupEntity(
                (int) $record->id,
                $record->name,
                $record->owners_count,
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
        $record = OwnerGroup::with('owners','owners.phones')->withCount('owners')->find($OwnerGroupId);
        if ($record) {
            //Owners DTO
            $arrayOfOwners = [];
            foreach($record->owners as $owner){
                $arrayOfOwners[] = new OwnerEntity(
                    $owner->id,
                    $owner->name,
                    $owner->nationalId,
                    $owner->address,
                    $owner->phones->pluck('phones')->toArray(),
                    $owner->notes,
                );
            }
            //OwnerGroup DTO
            $ownerGroupEntity  = new OwnerGroupEntity(
                $record->id,
                $record->name,
                $record->ownersCount,
                $arrayOfOwners,
            );
            return $ownerGroupEntity;
        }
        return null;
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
