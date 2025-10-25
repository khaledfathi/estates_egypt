<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceEntity;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceInvoiceEntity;
use App\Shared\Domain\Enum\Estate\EstateUtilityServiceType;
use App\Shared\Domain\Repositories\EstateUtilityServiceInvoiceRepository;
use App\Shared\Infrastructure\Models\Estate\EstateUtilityServiceInvoice;

final class EloquentEstateUtilityServiceInvoiceRepository implements EstateUtilityServiceInvoiceRepository
{
    public function index(): array
    {
        return [];
    }
    public function show(int  $invoiceId): ?EstateUtilityServiceInvoiceEntity
    {
        $record = EstateUtilityServiceInvoice::with('estateUtilityService')->find($invoiceId);

        if ($record) {
            //estate DTO
            $estateEntity = null;
            if ($record->estateUtilityService?->estate) {
                $estateRecord = $record->estateUtilityService->estate;
                $estateEntity = new EstateEntity(
                    $estateRecord->id,
                    $estateRecord->name,
                    $estateRecord->address,
                    $estateRecord->floor_count,
                );
            }
            //estate utility service DTO
            $estateUtilityServiceEntity = null;
            if ($record->estateUtilityService) {
                $estateUtilityServiceEntity = new EstateUtilityServiceEntity(
                    id: $record->estateUtilityService->id,
                    estateId: $record->estateUtilityService->estate_id,
                    type: EstateUtilityServiceType::from($record->estateUtilityService->type),
                    ownerName: $record->estateUtilityService->owner_name,
                    counterNumber: $record->estateUtilityService->counter_number,
                    electronicPaymentNumber: $record->estateUtilityService->electronic_payment_number,
                    notes: $record->estateUtilityService->notes,
                );
            }
            return new EstateUtilityServiceInvoiceEntity(
                id: $record->id,
                estateUtilityServiceId: $record->estateUtilityService->id,
                amount: $record->amount,
                forMonth: $record->for_month,
                forYear: $record->for_year,
                file: $record->file,
                estateUtilityService: $estateUtilityServiceEntity,
                estate: $estateEntity,
            );
        }
        return null;
    }

    public function update(EstateUtilityServiceInvoiceEntity $estateUtilityServiceInvoiceEntity): bool
    {
        $data = [
            'amount' => $estateUtilityServiceInvoiceEntity->amount,
            'for_month' => $estateUtilityServiceInvoiceEntity->forMonth,
            'for_year' => $estateUtilityServiceInvoiceEntity->forYear
        ];
        if ($estateUtilityServiceInvoiceEntity->file) {
            $data['file'] = $estateUtilityServiceInvoiceEntity->file;
        }
        return EstateUtilityServiceInvoice::find($estateUtilityServiceInvoiceEntity->id)->update($data);
    }
    public function store(EstateUtilityServiceInvoiceEntity $estateUtilityServiceInvoiceEntity): EstateUtilityServiceInvoiceEntity
    {
        $record = EstateUtilityServiceInvoice::create([
            'estate_utility_service_id' => $estateUtilityServiceInvoiceEntity->estateUtilityServiceId,
            'amount' => $estateUtilityServiceInvoiceEntity->amount,
            'for_month' => $estateUtilityServiceInvoiceEntity->forMonth,
            'for_year' => $estateUtilityServiceInvoiceEntity->forYear,
            'file' => $estateUtilityServiceInvoiceEntity->file,
        ]);
        $estateUtilityServiceInvoiceEntity->id = $record->id;
        return $estateUtilityServiceInvoiceEntity;
    }
    public function destroy(int $invoiceId): bool
    {
        return EstateUtilityServiceInvoice::find($invoiceId)?->delete() ?? false;
    }
}
