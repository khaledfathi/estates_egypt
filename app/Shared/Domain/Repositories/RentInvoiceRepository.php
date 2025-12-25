<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repositories; 

use App\Shared\Domain\Entities\RentsPayment\RentInvoiceEntity;
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
    public function indexWithPaginateByYear(int $year ): EntitiesWithPagination;
    public function store(RentInvoiceEntity $RentInvoiceEntity): RentInvoiceEntity;
    public function show(int $renterId): RentInvoiceEntity|null;
    public function update(RentInvoiceEntity $RentInvoiceEntity): bool;
    public function destroy(int $renterId): bool;
}
