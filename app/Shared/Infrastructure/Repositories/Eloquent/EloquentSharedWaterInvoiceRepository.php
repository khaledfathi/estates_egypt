<?php
declare (strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent; 

use App\Shared\Domain\Entities\SharedWaterInvoice\SharedWaterInvoiceEntity;
use App\Shared\Domain\Repositories\SharedWaterInvoiceRepository;

final class EloquentSharedWaterInvoiceRepository implements SharedWaterInvoiceRepository {
    /**
     * @return array<SharedWaterInvoiceEntity>
     */
    public function index(): array{
        return [];
    }
    public function show (int $sharedWaterInvoiceId):SharedWaterInvoiceEntity|null {
        return new SharedWaterInvoiceEntity();
    }
    public function store(SharedWaterInvoiceEntity $sharedWaterInvoiceEntity): SharedWaterInvoiceEntity{
        return new SharedWaterInvoiceEntity();
    }
    public function update(SharedWaterInvoiceEntity $sharedWaterInvoiceEntity): bool{
        return false;
    }
    public function destroy(int $sharedWaterInvoiceId): bool{
        return false;
    }
}