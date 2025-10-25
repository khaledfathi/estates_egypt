<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Features\Owners\Domain\ValueObjects\OwnerEntitiesWithPagination;
use App\Models\OwnerGroup;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Owner\OwnerEntity;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Domain\Entities\Owner\OwnerPhoneEntity;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\Enum\Unit\UnitType;
use App\Shared\Domain\Repositories\OwnerRepository;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Domain\ValueObjects\Pagination;
use App\Shared\Infrastructure\Models\Owner\Owner;
use App\Shared\Infrastructure\Models\Owner\OwnerPhone;

final class EloquentOwnerRepository implements OwnerRepository
{
    /**
     *
     * @inheritDoc
     */
    public function index(): array
    {
        $ownersRecords = Owner::with('phones')->orderBy('name', 'desc')->get();
        $arrayOfOwners = [];
        foreach ($ownersRecords as $record) {
            $arrayOfOwners[] = new OwnerEntity(
                (int) $record->id,
                $record->name,
                $record->national_id,
                $record->address,
                $record->phones->pluck('phone')->toArray(),
                $record->notes
            );
        }
        return $arrayOfOwners;
    }

    /**
     * 
     * @inheritDoc
     */
    public function indexWithPaginate(int $perPage): EntitiesWithPagination
    {
        //Query 
        $ownersRecords = Owner::with('phones')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        //Transform to DTO
        $arrayOfOwners = [];
        foreach ($ownersRecords as $record) {
            //phones DTO
            $ownerPhones = [];
            foreach ($record?->phones ?? [] as $phone) {
                $ownerPhones[]  =  new OwnerPhoneEntity(
                    (int)$phone->id,
                    (int)$phone->owner_id,
                    $phone->phone,
                );
            }
            //owner DTO
            $arrayOfOwners[] = new OwnerEntity(
                (int) $record->id,
                $record->name,
                $record->national_id,
                $record->address,
                $ownerPhones,
                $record->notes
            );
        }
        //Pagination DTO
        $paginationData = new Pagination(
            perPage: $ownersRecords->perPage(),
            currentPage: $ownersRecords->currentPage(),
            path: $ownersRecords->path(),
            pageName: $ownersRecords->getPageName(),
            total: $ownersRecords->total()
        );
        //Final DTO
        return  new OwnerEntitiesWithPagination(
            $paginationData,
            $arrayOfOwners
        );
    }

    public function store(OwnerEntity $ownerEntity): OwnerEntity
    {
        $ownerRecord = Owner::create([
            'name' => $ownerEntity->name,
            'national_id' => $ownerEntity->nationalId,
            'address' => $ownerEntity->address,
            'notes' => $ownerEntity->notes,
        ]);
        foreach ($ownerEntity->phones as $phone) {
            OwnerPhone::create([
                'owner_id' => $ownerRecord->id,
                'phone' => $phone->phone,
            ]);
        }
        $ownerEntity->id = $ownerRecord->id;
        return $ownerEntity;
    }
    public function show(int $ownerId): OwnerEntity|null
    {
        $record = Owner::with('phones', 'unitOwnerships.unit', 'unitOwnerships.unit.estate',  'ownerInGroups', 'ownerInGroups.group')
            ->withCount('ownerInGroups')
            ->find($ownerId);
        if ($record) {
            $ownerPhones = [];
            foreach ($record->phones ?? [] as $phone) {
                $ownerPhones[]  =  new OwnerPhoneEntity(
                    (int)$phone->id,
                    (int)$phone->owner_id,
                    $phone->phone,
                );
            }

            $ownerGroups = [];
            foreach ($record->ownerInGroups as $ownerGroup) {
                $ownerGroups[] = new OwnerGroupEntity(
                    id : $ownerGroup->group->id,
                    name :$ownerGroup->group->name,
                    ownersCount : $ownerGroup->owner_in_groups_count,
                );
            }

            $unitEntities = [];
            foreach ($record->unitOwnerships as $unitOwnership) {
                //unit DTO
                $unitEntity = new UnitEntity(
                    id: $unitOwnership->unit->id,
                    estateId: $unitOwnership->unit->estate_id,
                    number: $unitOwnership->unit->number,
                    floorNumber: $unitOwnership->unit->floor_number,
                    type: UnitType::from($unitOwnership->unit->type),
                    isEmpty: $unitOwnership->unit->is_empty ? true : false,
                    ownershipId:$unitOwnership->id,
                );
                //estate DTO - merged to unit entity
                $unitEntity->estate = new EstateEntity(
                    id: $unitOwnership->unit->estate->id,
                    name: $unitOwnership->unit->estate->name,
                    address: $unitOwnership->unit->estate->address,
                    floorCount: $unitOwnership->unit->estate->floor_count,
                    commercialUnitCount: $unitOwnership->unit->estate->commercial_unit,
                    residentialUnitCount: $unitOwnership->unit->estate->residential_unit,
                );
                $unitEntities[] = $unitEntity;
            }
            //owner DTO
            $ownerEntity = new OwnerEntity(
                id: $record->id,
                name: $record->name,
                nationalId: $record->national_id,
                address: $record->address,
                phones: $ownerPhones,
                notes: $record->notes,
                units:$unitEntities,
                ownerGroups:$ownerGroups
            );
            return $ownerEntity;
        }
        return null;
    }
    public function update(ownerEntity $ownerEntity): bool
    {
        $find = Owner::with('phones')->find($ownerEntity->id);
        if ($find) {
            //update record
            $updateStatus = $find->update([
                'name' => $ownerEntity->name,
                'national_id' => $ownerEntity->nationalId,
                'address' => $ownerEntity->address,
                'notes' => $ownerEntity->notes,
            ]);

            // *- update phone releated to this owner record
            // 1- delete current phones 
            OwnerPhone::where('owner_id', $ownerEntity->id)->delete();
            // 2- store new phones 
            foreach ($ownerEntity->phones as $phone) {
                OwnerPhone::create([
                    'owner_id' => $ownerEntity->id,
                    'phone' => $phone->phone,
                ]);
            }
            return $updateStatus;
        }
        return false;
    }

    public function destroy(int $ownerId): bool
    {
        return Owner::find($ownerId)->delete();
    }
}
