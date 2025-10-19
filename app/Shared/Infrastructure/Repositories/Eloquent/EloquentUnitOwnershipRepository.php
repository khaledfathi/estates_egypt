<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Shared\Domain\Entities\Unit\UnitOwnershipEntity;
use App\Shared\Domain\Repositories\UnitOwnershipRepository;
use App\Shared\Infrastructure\Models\Unit\UnitOwnership;

final class EloquentUnitOwnershipRepository implements UnitOwnershipRepository
{

    public function store(UnitOwnershipEntity $unitOwnershipEntity): UnitOwnershipEntity
    {
        $record = UnitOwnership::create([
            'unit_id' => $unitOwnershipEntity->unitId,
            'owner_id' => $unitOwnershipEntity->ownerId,
        ]);
        $unitOwnershipEntity->id = $record->id;
        return $unitOwnershipEntity;
    }
    public function storeManyOwners(int $unitId , array $ownersIds): array
    {
        $dataToInsert = [];
        //prevent N+1 Problem 
        foreach ($ownersIds as $ownerId) {
            $dataToInsert[] = [
                'unit_id' => $unitId ,
                'owner_id' => $ownerId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // --- 
        $storedUnitOwnershipsentitites = [];
        if (!empty($dataToInsert)) {
            //store 
            UnitOwnership::insertOrIgnore($dataToInsert);
            //
            $unitIds = array_column($dataToInsert, 'unit_id');
            $ownerIds = array_column($dataToInsert, 'owner_id');
            //
            $storedRecords = UnitOwnership::whereIn('unit_id', $unitIds)
                ->whereIn('owner_id', $ownerIds)
                ->get();
            //
            foreach ($storedRecords as $record) {
                $storedUnitOwnershipsentitites[] = new UnitOwnershipEntity(
                    $record->id,
                    $record->unit_id,
                    $record->owner_id,
                );
            }
        }
        return $storedUnitOwnershipsentitites;
    }
    public function destroy(int $unitOwnershipId): bool
    {
        return UnitOwnership::find($unitOwnershipId)->delete();
    }
}
