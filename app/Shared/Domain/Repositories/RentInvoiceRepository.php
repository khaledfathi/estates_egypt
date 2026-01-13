<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repositories; 

use App\Shared\Domain\Entities\RentInvoice\RentInvoiceEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface RentInvoiceRepository 
{
    /**
     * 
     * @return array<RentInvoiceEntity> 
     */
    public function index(): array;
    /**
     * 
     * @param int $perPagRentInvoiceRepositorye
     * @return EntitiesWithPagination<RentInvoiceEntity>
     */
    public function indexWithPaginateByYear(int $year , int $contractId): EntitiesWithPagination;
    public function store(RentInvoiceEntity $RentInvoiceEntity): RentInvoiceEntity;
    public function show(int $rentInvoiceId): RentInvoiceEntity|null;
    public function update(RentInvoiceEntity $RentInvoiceEntity): bool;
    public function destroy(int $rentInvoiceId): bool;
}
