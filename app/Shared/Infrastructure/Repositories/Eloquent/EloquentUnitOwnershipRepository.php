<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Shared\Domain\Entities\Unit\UnitOwnershipEntity;
use App\Shared\Domain\Repositories\UnitOwnershipRepository;
use App\Shared\Infrastructure\Models\Unit\UnitOwnership;

class EloquentUnitOwnershipRepository implements UnitOwnershipRepository
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
    public function destroy (int $unitOwnershipId):bool{
        return UnitOwnership::find($unitOwnershipId)->delete();
    }
}
