<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repositories;

use App\Features\RentsPayment\Presentation\Http\Controllers\RenterPaymentEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Infrastructure\Models\Renter\Renter;

interface RenterPaymentRepository
{
    /**
     * 
     * @return array<RenterPaymentEntity> 
     */
    public function index(): array;
    /**
     * 
     * @param int $perPage
     * @return EntitiesWithPagination<RenterPaymentEntity>
     */
    public function indexWithPaginate(int $perPage): EntitiesWithPagination;
    public function store(RenterPaymentEntity $renterPaymentEntity): RenterPaymentEntity;
    public function show(int $renterId): Renter|null;
    public function update(RenterPaymentEntity $renterPaymentEntity): bool;
    public function destroy(int $renterId): bool;
}
