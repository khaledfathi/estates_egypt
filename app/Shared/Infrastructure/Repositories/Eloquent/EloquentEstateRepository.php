<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Features\Estates\Domain\ValueObjects\EstateEntitiesWithPagination;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Enum\Unit\UnitType;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Domain\ValueObjects\Pagination;
use App\Shared\Infrastructure\Models\Estate\Estate;

final class EloquentEstateRepository implements EstateRepositroy
{
    /**
     * 
     * @return array<EstateEntity> 
     */
    public function index(): array
    {

        //Query 
        $estateRecords = Estate::withCount([
            'units as residential_unit_count' => fn($query) => $query->where('type', UnitType::RESDENTIAL->value),
            'units as commercial_unit_count' => fn($query) => $query->where('type', UnitType::COMMERCIAL->value),
            'units as total_unit_count'
        ])
            ->orderBy('created_at', 'desc')
            ->get();

        //Transform to DTO
        $arrayOfEstates = [];
        foreach ($estateRecords as $record) {
            //estate DTO
            $arrayOfEstates[] = new EstateEntity(
                id: (int) $record->id,
                name: $record->name,
                address: $record->address,
                floorCount: $record->floor_count,
                unitCount: $record->total_unit_count,
                residentialUnitCount: $record->residential_unit_count,
                commercialUnitCount: $record->commercial_unit_count
            );
        }
        return $arrayOfEstates;
    }
    /**
     * 
     * @inheritDoc
     */
    public function indexWithPaginate(int $perPage): EntitiesWithPagination
    {
        //Query 
        $estateRecords = Estate::withCount([
            'units as residential_unit_count' => fn($query) => $query->where('type', UnitType::RESDENTIAL->value),
            'units as commercial_unit_count' => fn($query) => $query->where('type', UnitType::COMMERCIAL->value),
            'units as total_unit_count'
        ])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        //Transform to DTO
        $arrayOfEstates = [];
        foreach ($estateRecords as $record) {
            //estate DTO
            $arrayOfEstates[] = new EstateEntity(
                id: (int) $record->id,
                name: $record->name,
                address: $record->address,
                floorCount: $record->floor_count,
                unitCount: $record->total_unit_count,
                residentialUnitCount: $record->residential_unit_count,
                commercialUnitCount: $record->commercial_unit_count
            );
        }
        //Pagination DTO
        $paginationData = new Pagination(
            perPage: $estateRecords->perPage(),
            currentPage: $estateRecords->currentPage(),
            path: $estateRecords->path(),
            pageName: $estateRecords->getPageName(),
            total: $estateRecords->total()
        );
        //Final DTO
        return  new EstateEntitiesWithPagination(
            $paginationData,
            $arrayOfEstates
        );
    }
    public function store(EstateEntity $estateEntity): EstateEntity
    {
        $record = Estate::create([
            'name' => $estateEntity->name,
            'address' => $estateEntity->address,
            'floor_count' => $estateEntity->floorCount,
        ]);
        $estateEntity->id = $record->id;
        return $estateEntity;
    }

    public function show(int $estateId): EstateEntity|null
    {
        $record = Estate::withCount([
            'units as residential_unit_count' => fn($query) => $query->where('type', UnitType::RESDENTIAL->value),
            'units as commercial_unit_count' => fn($query) => $query->where('type', UnitType::COMMERCIAL->value),
            'units as total_unit_count'
        ])->find($estateId);
        if ($record) {
            $estateEntity = new EstateEntity(
                id: $record->id,
                name: $record->name,
                address: $record->address,
                floorCount: $record->floor_count,
                unitCount: $record->total_unit_count,
                residentialUnitCount: $record->residential_unit_count,
                commercialUnitCount: $record->commercial_unit_count
            );
            return  $estateEntity;
        }
        return null;
    }
    public function update(EstateEntity $estateEntity): bool
    {
        return true;
    }
    public function destroy(int $estateId): bool
    {
        return true;
    }
}
