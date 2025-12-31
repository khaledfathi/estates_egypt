<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Shared\Domain\Entities\SharedWaterInvoice\SharedWaterInvoiceEntity;
use App\Shared\Domain\Repositories\SharedWaterInvoiceRepository;
use App\Shared\Infrastructure\Models\SharedWaterInvoice\SharedWaterInvoice;

final class EloquentSharedWaterInvoiceRepository implements SharedWaterInvoiceRepository
{
    /**
     * @return array<SharedWaterInvoiceEntity>
     */
    public function index(): array
    {
        return [];
    }
    /**
     * @return array<SharedWaterInvoiceEntity>
     */
    public function indexByYear(int $contractId, int $year): array
    {
        $sharedWaterInvoicesRecords = SharedWaterInvoice::where('contract_id', $contractId)->where('for_year', $year)->get();
        //----- make entities; 
        return [];
    }
    public function show(int $sharedWaterInvoiceId): SharedWaterInvoiceEntity|null
    {
        return new SharedWaterInvoiceEntity();
    }
    public function store(SharedWaterInvoiceEntity $sharedWaterInvoiceEntity): SharedWaterInvoiceEntity
    {
        SharedWaterInvoice::create([
            'contract_id' => $sharedWaterInvoiceEntity->contractId,
            'transaction_id' => $sharedWaterInvoiceEntity->transactionId,
            'shared_value' => $sharedWaterInvoiceEntity->sharedValue,
            'for_month' => $sharedWaterInvoiceEntity->forMonth,
            'for_year' => $sharedWaterInvoiceEntity->forYear,
        ]);
        return new SharedWaterInvoiceEntity();
    }
    public function update(SharedWaterInvoiceEntity $sharedWaterInvoiceEntity): bool
    {
        return false;
    }
    public function destroy(int $sharedWaterInvoiceId): bool
    {
        return false;
    }
}
