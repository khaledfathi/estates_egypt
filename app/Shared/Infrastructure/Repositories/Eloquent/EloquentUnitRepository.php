<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Features\Units\Domain\ValueObjects\UnitEntitiesWithPagination;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\Enum\Unit\UnitOwnershipType;
use App\Shared\Domain\Enum\Unit\UnitType;
use App\Shared\Domain\Repositories\UnitRepository;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Domain\ValueObjects\Pagination;
use App\Shared\Infrastructure\Models\Unit\Unit;


final class EloquentUnitRepository implements UnitRepository
{
    /**
     * 
     * @inheritDoc
     */
    public function index(): array
    {
        return [];
    }

    /**
     * 
     * @inheritDoc
     */
    public function indexWithPaginate(int $estateId, int $perPage): EntitiesWithPagination
    {
        //Query 
        $unitsRecords = Unit::where('estate_id', $estateId)
            ->orderBy('type', 'desc')->orderBy('number', 'asc')
            ->paginate($perPage);

        //Transform to DTO
        $arrayOfUnits = [];
        foreach ($unitsRecords as $record) {
            //units DTO
            $arrayOfUnits[] = new UnitEntity(
                id: (int) $record->id,
                estateId: $record->estate_id,
                number: $record->number,
                floorNumber: $record->floor_number,
                type: UnitType::from($record->type),
                ownershipType: UnitOwnershipType::from($record->ownership_type),
                utilityServices: null,
                isEmpty: $record->is_empty ? true : false,
            );
        }
        //Pagination DTO
        $paginationData = new Pagination(
            perPage: $unitsRecords->perPage(),
            currentPage: $unitsRecords->currentPage(),
            path: $unitsRecords->path(),
            pageName: $unitsRecords->getPageName(),
            total: $unitsRecords->total(),
        );
        //Final DTO
        return  new UnitEntitiesWithPagination(
            $paginationData,
            $arrayOfUnits
        );
    }

    public function store(UnitEntity $unitEntity): UnitEntity
    {
        $record = Unit::create([
            'estate_id' => $unitEntity->estateId,
            'number' => $unitEntity->number,
            'floor_number' => $unitEntity->floorNumber,
            'ownership_type' => $unitEntity->ownershipType->value, //enum
            'type' => $unitEntity->type->value, //enum
            'is_empty' => $unitEntity->isEmpty,
        ]);
        $unitEntity->id = $record->id;
        return $unitEntity;
    }

    public function show(int $unitId, bool $unitOnly = false): UnitEntity|null
    {

        $record = $unitOnly
            ? Unit::find($unitId)
            : Unit::with('estate')->find($unitId);
        if (!$record) return null;

        $estateEntity = $record->estate
            ?  new EstateEntity(
                id: $record->estate->id,
                name: $record->estate->name,
                address: $record->estate->address,
                floorCount: $record->estate->floor_count,
            ) : null;
        return new UnitEntity(
            id: $record->id,
            estateId: $record->number,
            number: $record->number,
            floorNumber: $record->floor_number,
            type: UnitType::from($record->type),
            ownershipType: UnitOwnershipType::from($record->ownership_type),
            isEmpty: $record->is_empty ? true : false,
            estate: $estateEntity
        );
    }
    public function update(UnitEntity $unitEntity): bool
    {
        return Unit::find($unitEntity->id)
            ->update([
                'number' => $unitEntity->number,
                'floor_number' => $unitEntity->floorNumber,
                'ownership_type' => $unitEntity->ownershipType->value, //enum
                'type' => $unitEntity->type->value, //enum
                'is_empty' => $unitEntity->isEmpty,
            ]);
    }
    public function destroy(int $unitId): bool
    {
        return Unit::find($unitId)->delete();
    }
}
