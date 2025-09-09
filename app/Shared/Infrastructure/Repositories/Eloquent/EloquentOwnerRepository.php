<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Features\Owners\Domain\ValueObjects\OwnerEntitiesWithPagination;
use App\Shared\Domain\Entities\OwnerEntity;
use App\Shared\Domain\Repositories\OwnerRepository;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Domain\ValueObjects\Pagination;

use App\Shared\Infrastructure\Models\Owner;
use App\Shared\Infrastructure\Models\OwnerPhone;

final class EloquentOwnerRepository implements OwnerRepository
{
    /**
     *
     * @inheritDoc
     */
    public function index(): array
    {
        $owenrsRecords = Owner::with('phones')->get();
        $arrayOfOwners = [];
        foreach ($owenrsRecords as $record) {
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

    public function indexWithPaginate(int $perPage): EntitiesWithPagination
    {
        $owenrsRecords = Owner::with('phones')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        $arrayOfOwners = [];
        foreach ($owenrsRecords as $record) {
            $arrayOfOwners[] = new OwnerEntity(
                (int) $record->id,
                $record->name,
                $record->national_id,
                $record->address,
                $record->phones->pluck('phone')->toArray(),
                $record->notes
            );
        }
        $paginationData = new Pagination(

            perPage: $owenrsRecords->perPage(),
            currentPage: $owenrsRecords->currentPage(),
            path: $owenrsRecords->path(),
            pageName: $owenrsRecords->getPageName(),
            total: $owenrsRecords->total()
        );
        $arrayOfOwnersWithPagination = new OwnerEntitiesWithPagination(
            $paginationData,
            $arrayOfOwners
        );
        return $arrayOfOwnersWithPagination;
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
                'phone' => $phone,
            ]);
        }
        $ownerEntity->id = $ownerRecord->id;
        return $ownerEntity;
    }
    public function show(int $ownerId): OwnerEntity|null
    {
        $record = Owner::with('phones')->find($ownerId);
        if ($record) {
            $ownerEntity = new OwnerEntity(
                $record->id,
                $record->name,
                $record->national_id,
                $record->address,
                $record->phones->pluck('phone')->toArray(),
                $record->notes
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

            //update phone releated to this owner record

            //delete current phones 
            OwnerPhone::where('owner_id', $ownerEntity->id)->delete();
            //store new phones 
            foreach ($ownerEntity->phones as $phone) {
                OwnerPhone::create([
                    'owner_id' => $ownerEntity->id,
                    'phone' => $phone,
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
