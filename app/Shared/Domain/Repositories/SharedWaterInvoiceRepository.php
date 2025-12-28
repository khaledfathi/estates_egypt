<?php
declare (strict_types=1);

namespace App\Shared\Domain\Repositories; 

use App\Shared\Domain\Entities\SharedWaterInvoice\SharedWaterInvoiceEntity;

interface SharedWaterInvoiceRepository {
    /**
     * @return array<SharedWaterInvoiceEntity>
     */
    public function index(): array;
    /**
     * @return array<SharedWaterInvoiceEntity>
     */
    public function indexByYear (int $contractId , int $year): array;
    public function show (int $sharedWaterInvoiceId):SharedWaterInvoiceEntity|null ;
    public function store(SharedWaterInvoiceEntity $sharedWaterInvoiceEntity): SharedWaterInvoiceEntity;
    public function update(SharedWaterInvoiceEntity $sharedWaterInvoiceEntity): bool;
    public function destroy(int $sharedWaterInvoiceId): bool;
}