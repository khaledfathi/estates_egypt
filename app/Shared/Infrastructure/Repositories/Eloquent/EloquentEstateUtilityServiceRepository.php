<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceEntity;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceInvoiceEntity;
use App\Shared\Domain\Enum\Estate\EstateUtilityServiceType;
use App\Shared\Domain\Repositories\EstateUtilityServiceRepository;
use App\Shared\Infrastructure\Models\Estate\EstateUtilityService;

final class EloquentEstateUtilityServiceRepository implements EstateUtilityServiceRepository
{

    /**
     * 
     * @inheritDoc 
     */
    public function indexWhereEstate(int $estateId): array
    {
        $records = EstateUtilityService::where('estate_id', $estateId)->get();
        $estateUtilityServicesEntities = [];
        foreach ($records as $record) {
            $estateUtilityServicesEntities[] = new EstateUtilityServiceEntity(
                id: $record->id,
                estateId: $record->estate_id,
                type: EstateUtilityServiceType::from($record->type),
                ownerName: $record->owner_name,
                counterNumber: $record->counter_number,
                electronicPaymentNumber: $record->electronic_payment_number,
                notes: $record->note,
            );
        }
        return $estateUtilityServicesEntities;
    }
    /**
     * @inheritDoc
     */
    public function show(int $estateUtilityServiceId): ?EstateUtilityServiceEntity
    {
        $record = EstateUtilityService::with('estate', 'estateUtilityServiceInvoices')->find($estateUtilityServiceId);
        if ($record) {
            //estate DTO 
            $estateEntity = new EstateEntity(
                id: $record->estate->id,
                name: $record->estate->name,
                address: $record->estate->address,
                floorCount: $record->estate->floor_count,

            );
            //estateUtilityServiceInvoices DTO
            $estateUtilityServiceInvoices = [];
            foreach ($record->estateUtilityServiceInvoices as $invoice) {
                $estateUtilityServiceInvoices[] = new EstateUtilityServiceInvoiceEntity(
                    id: $invoice->id,
                    estateUtilityServiceId: $invoice->estate_utility_service_id,
                    amount: $invoice->amount,
                    forMonth: $invoice->for_month,
                    forYear: $invoice->for_year,
                    file: $invoice->file,
                );
            }
            return new EstateUtilityServiceEntity(
                id: $record->id,
                estateId: $record->estate_id,
                type: EstateUtilityServiceType::from($record->type),
                ownerName: $record->owner_name,
                counterNumber: $record->counter_number,
                electronicPaymentNumber: $record->electronic_payment_number,
                notes: $record->notes,
                estate: $estateEntity,
                invoices: $estateUtilityServiceInvoices,
            );
        }
        return null;
    }
    public function showWithInvoicesByYear(int $estateUtilityServiceId, int $year):?EstateUtilityServiceEntity
    {
        $record = EstateUtilityService::with([
            'estate',
            'estateUtilityServiceInvoices' => fn($query) => $query->where('for_year', $year)
        ])->find($estateUtilityServiceId);
        if ($record) {
            //estateDTO
            $estateEntity = new EstateEntity(
                id: $record->estate->id,
                name: $record->estate->name,
                address: $record->estate->address,
                floorCount: $record->estate->floor_count,
            );
            //estateUtilityServiceInvoices DTO
            $estateUtilityServiceInvoices = [];
            foreach ($record->estateUtilityServiceInvoices as $invoice) {
                $estateUtilityServiceInvoices[] = new EstateUtilityServiceInvoiceEntity(
                    id: $invoice->id,
                    estateUtilityServiceId: $invoice->estate_utility_service_id,
                    amount: $invoice->amount,
                    forMonth: $invoice->for_month,
                    forYear: $invoice->for_year,
                    file: $invoice->file,
                );
            }
            //estateUtilityService DTO
            return new EstateUtilityServiceEntity(
                id: $record->id,
                estateId: $record->estate_id,
                type: EstateUtilityServiceType::from($record->type),
                ownerName: $record->owner_name,
                counterNumber: $record->counter_number,
                electronicPaymentNumber: $record->electronic_payment_number,
                notes: $record->notes,
                estate: $estateEntity,
                invoices: $estateUtilityServiceInvoices,
            );
        }
        return null;
    }
    public function store(EstateUtilityServiceEntity $estateUtilityServiceEntity): EstateUtilityServiceEntity
    {
        $record = EstateUtilityService::create([
            'estate_id' => $estateUtilityServiceEntity->estateId,
            'type' => $estateUtilityServiceEntity->type->value,
            'owner_name' => $estateUtilityServiceEntity->ownerName,
            'counter_number' => $estateUtilityServiceEntity->counterNumber,
            'electronic_payment_number' => $estateUtilityServiceEntity->electronicPaymentNumber,
            'notes' => $estateUtilityServiceEntity->notes,
        ]);
        $estateUtilityServiceEntity->id = $record->id;
        return $estateUtilityServiceEntity;
    }
    public function update(EstateUtilityServiceEntity $estateUtilityServiceEntity): bool
    {
        $found = EstateUtilityService::find($estateUtilityServiceEntity->id);
        return $found
            ? $found->update([
                'type' => $estateUtilityServiceEntity->type->value,
                'owner_name' => $estateUtilityServiceEntity->ownerName,
                'counter_number' => $estateUtilityServiceEntity->counterNumber,
                'electronic_payment_number' => $estateUtilityServiceEntity->electronicPaymentNumber,
                'notes' => $estateUtilityServiceEntity->notes,
            ])
            : false;
    }
    public function destroy(int $estateUtilityServiceId): bool
    {
        return EstateUtilityService::find($estateUtilityServiceId)->delete();
    }
}
