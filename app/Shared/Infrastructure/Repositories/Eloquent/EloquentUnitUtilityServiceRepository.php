<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\Entities\Unit\UnitUtilityServiceEntity;
use App\Shared\Domain\Enum\Unit\UnitType;
use App\Shared\Domain\Enum\Unit\UnitUtilityServiceType;
use App\Shared\Domain\Repositories\UnitUtilityServiceRepository;
use App\Shared\Infrastructure\Models\Unit\UnitUtilityService;

final class EloquentUnitUtilityServiceRepository implements UnitUtilityServiceRepository
{
    /**
     * @inheritDoc 
     */
    public function index(int $unitId): array
    {
        $records = UnitUtilityService::where('unit_id', $unitId)->get();
        $unitUtilityServicesEntities = [];
        foreach ($records as $record) {
            $unitUtilityServicesEntities[] = new UnitUtilityServiceEntity(
                $record->id,
                $record->unit_id,
                UnitUtilityServiceType::from($record->type),
                $record->owner_name,
                $record->counter_number,
                $record->electronic_payment_number,
                $record->notes
            );
        }
        return $unitUtilityServicesEntities;
    }

    public function store(UnitUtilityServiceEntity $unitUtilityServiceEntity): UnitUtilityServiceEntity
    {
        $record = UnitUtilityService::create([
            'unit_id' => $unitUtilityServiceEntity->unitId,
            'type' => $unitUtilityServiceEntity->type->value,
            'owner_name' => $unitUtilityServiceEntity->ownerName,
            'counter_number' => $unitUtilityServiceEntity->counterNumber,
            'electronic_payment_number' => $unitUtilityServiceEntity->electronicPaymentNumber,
            'notes' => $unitUtilityServiceEntity->notes,
        ]);
        $unitUtilityServiceEntity->id = $record->id;
        return  $unitUtilityServiceEntity;
    }

    /**
     * @inheritDoc
     */
    public function show(int $unitUtilityServiceId): UnitUtilityServiceEntity|null
    {
        $unitUtilityServiceRecord = UnitUtilityService::find($unitUtilityServiceId);
        $unitEntity = null;
        $estateEntity = null;
        if (!$unitUtilityServiceRecord) return null;
        //unit
        if ($unitUtilityServiceRecord->unit) {
            $unitEntity = new UnitEntity(
                id: $unitUtilityServiceRecord->unit->id,
                estateId: $unitUtilityServiceRecord->unit->estate_id,
                number: $unitUtilityServiceRecord->unit->number,
                floorNumber: $unitUtilityServiceRecord->unit->floor_number,
                type: UnitType::from($unitUtilityServiceRecord->unit->type),
                isEmpty: $unitUtilityServiceRecord->unit->is_empty ? true : false,
            );
        }
        //estate
        if ($unitUtilityServiceRecord->unit->estate) {
            $estateEntity = new EstateEntity(
                id : $unitUtilityServiceRecord->unit->estate->id,
                name : $unitUtilityServiceRecord->unit->estate->name,
                address :$unitUtilityServiceRecord->unit->estate->address ,
            );
        }
        return new UnitUtilityServiceEntity(
            $unitUtilityServiceRecord->id,
            $unitUtilityServiceRecord->unit_id,
            unitUtilityServiceType::from($unitUtilityServiceRecord->type),
            $unitUtilityServiceRecord->owner_name,
            $unitUtilityServiceRecord->counter_number,
            $unitUtilityServiceRecord->electronic_payment_number,
            $unitUtilityServiceRecord->notes,
            $unitEntity,
            $estateEntity,
        );
    }
    public function update(UnitUtilityServiceEntity $unitUtilityServiceEntity): bool
    {

        return UnitUtilityService::find($unitUtilityServiceEntity->id)->update([
            'type' => $unitUtilityServiceEntity->type->value,
            'owner_name' => $unitUtilityServiceEntity->ownerName,
            'counter_number' => $unitUtilityServiceEntity->counterNumber,
            'electronic_payment_number' => $unitUtilityServiceEntity->electronicPaymentNumber,
            'notes' => $unitUtilityServiceEntity->notes,
        ]);
    }
    public function destroy(int $unitUtilityServiceId): bool
    {
        return UnitUtilityService::find($unitUtilityServiceId)->delete();
    }
}
