<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Features\UnitContracts\Domain\ValueObjects\UnitContractEntitiesWithPagination;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Renter\RenterEntity;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\Enum\Renter\RenterIdentityType;
use App\Shared\Domain\Enum\Unit\UnitContractType;
use App\Shared\Domain\Enum\Unit\UnitType;
use App\Shared\Domain\Repositories\UnitContractRepository;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Domain\ValueObjects\Pagination;
use App\Shared\Infrastructure\Models\Unit\UnitContract;
use App\Shared\Infrastructure\Utilities\CarbonDateUtility;

final class EloquentUnitContractRepository implements UnitContractRepository
{
    /**
     * @inheritDoc
     */
    public function index(int $perPage): array
    {
        return [];
    }
    /**
     * @inheritDoc
     */
    public function indexWithPaginateByUnitId(int $unitId, int $perPage): EntitiesWithPagination
    {
        $records = UnitContract::with(['renter', 'unit'])
            ->where('unit_id', $unitId)->orderBy('end_date', 'desc')->paginate($perPage);
        $unitContractEntities = [];
        foreach ($records as $record) {
            //Unit DTO
            $unitEntity = new UnitEntity(
                id: $record->unit->id,
                estateId: $record->unit->estate_id,
                number: $record->unit->number,
                floorNumber: $record->unit->floor_number,
                type: UnitType::from($record->unit->type),
                isEmpty: $record->unit->isEmpty ? true : false,
            );
            //renter DTO
            $renterEntity = null;
            if (isset($record->renter)) {
                $renterEntity = new RenterEntity(
                    id: $record->renter->id,
                    name: $record->renter->name,
                    identityType: RenterIdentityType::from($record->renter->identity_type),
                    identityNumber: $record->renter->identity_number,
                    notes: $record->renter->notes,
                );
            }
            //UnitContract entity DTO
            $unitContractEntities[] = new UnitContractEntity(
                id: $record->id,
                unitId: $record->unit_id,
                renterId: $record->renter_id,
                type: UnitContractType::from($record->type),
                rentValue: $record->rent_value,
                annualRentIncreasement: $record->annual_rent_increasement,
                insuranceValue: $record->insurance_value,
                startDate: CarbonDateUtility::from($record->start_date),
                endDate: CarbonDateUtility::from($record->end_date),
                waterInvoicePercentage: $record->water_invoice_percentage,
                electricityInvoicePercentage: $record->electricity_invoice_percentage,
                renter: $renterEntity,
                unit: $unitEntity,
            );
            //
        }
        $paginationData = new Pagination(
            perPage: $records->perPage(),
            currentPage: $records->currentPage(),
            path: $records->path(),
            pageName: $records->getPageName(),
            total: $records->total(),
        );
        return  new UnitContractEntitiesWithPagination(
            $paginationData,
            $unitContractEntities
        );
    }

    public function store(UnitContractEntity $UnitContractEntity): UnitContractEntity
    {
        $record = UnitContract::create([
            'unit_id' => $UnitContractEntity->unitId,
            'renter_id' => $UnitContractEntity->renterId,
            'type' => $UnitContractEntity->type->value,
            'rent_value' => $UnitContractEntity->rentValue,
            'annual_rent_increasement' => $UnitContractEntity->annualRentIncreasement,
            'insurance_value' => $UnitContractEntity->insuranceValue,
            'start_date' => $UnitContractEntity->startDate->toDateString(),
            'end_date' => $UnitContractEntity->endDate->toDateString(),
            'water_invoice_precentage' => $UnitContractEntity->waterInvoicePercentage,
            'electricity_invoice_precentage' => $UnitContractEntity->electricityInvoicePercentage,
        ]);
        $UnitContractEntity->id = $record->id;
        return $UnitContractEntity;
    }
    public function show(int $UnitContractId): UnitContractEntity|null
    {
        $record = UnitContract::with(['renter', 'renter.phones', 'unit', 'unit.estate'])->find($UnitContractId);
        if ($record) {
            //Estaet DTO
            $estateEntity = new EstateEntity(
                id: $record->unit->estate->id,
                name: $record->unit->estate->name,
                address: $record->unit->estate->address,
                floorCount: $record->unit->estate->floor_count,
            );
            //Unit DTO
            $unitEntity = new UnitEntity(
                id: $record->unit->id,
                estateId: $record->unit->estate_id,
                number: $record->unit->number,
                floorNumber: $record->unit->floor_number,
                type: UnitType::from($record->unit->type),
                isEmpty: $record->unit->isEmpty ? true : false,
                estate: $estateEntity,
            );
            //renter DTO
            $renterEntity = null;
            if (isset($record->renter)) {
                $renterEntity = new RenterEntity(
                    id: $record->renter->id,
                    name: $record->renter->name,
                    identityType: RenterIdentityType::from($record->renter->identity_type),
                    identityNumber: $record->renter->identity_number,
                    notes: $record->renter->notes,
                    phones: $record->renter->phones->pluck('phone')->toArray(),
                );
            }
            //UnitContract entity DTO
            $unitContractEntity = new UnitContractEntity(
                id: $record->id,
                unitId: $record->unit_id,
                renterId: $record->renter_id,
                type: UnitContractType::from($record->type),
                rentValue: $record->rent_value,
                annualRentIncreasement: $record->annual_rent_increasement,
                insuranceValue: $record->insurance_value,
                startDate: CarbonDateUtility::from($record->start_date),
                endDate: CarbonDateUtility::from($record->end_date),
                waterInvoicePercentage: $record->water_invoice_percentage,
                electricityInvoicePercentage: $record->electricity_invoice_percentage,
                renter: $renterEntity,
                unit: $unitEntity,
            );
            //
            return $unitContractEntity;
        }
        return null;
    }
    public function update(UnitContractEntity $unitContractEntity): bool
    {
        return UnitContract::find($unitContractEntity->id)->update([
            'unit_id' =>  $unitContractEntity->unitId,
            'renter_id' => $unitContractEntity->renterId,
            'type' => $unitContractEntity->type->value,
            'rent_value' => $unitContractEntity->rentValue,
            'annual_rent_increasement' => $unitContractEntity->annualRentIncreasement,
            'insurance_value' => $unitContractEntity->insuranceValue,
            'start_date' => $unitContractEntity->startDate->toDateString(),
            'end_date' => $unitContractEntity->endDate->toDateString(),
            'water_invoice_percentage' => $unitContractEntity->waterInvoicePercentage,
            'electricity_invoice_percentage' => $unitContractEntity->electricityInvoicePercentage,
        ]);
    }
    public function destroy(int $UnitContractEntity): bool
    {
        return UnitContract::find($UnitContractEntity)->delete();
    }
}
