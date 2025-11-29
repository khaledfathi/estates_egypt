<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent; 

use App\Features\RentsPayment\Presentation\Http\Controllers\RenterPaymentEntity;
use App\Shared\Domain\Repositories\RenterPaymentRepository;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Infrastructure\Models\Renter\Renter;

final class EloquentRenterPaymentRepository implements RenterPaymentRepository
{
    /**
     * @inheritDoc
     */
    public function index(): array {
        return [];
    }
    /**
     * @inheritDoc
     */
    public function indexWithPaginate(int $perPage): EntitiesWithPagination {
        return new EntitiesWithPagination();
    }
    public function store(RenterPaymentEntity $renterPaymentEntity): RenterPaymentEntity {
        return new RenterPaymentEntity();
    }
    public function show(int $renterId): Renter|null {
        return null;
    }
    public function update(RenterPaymentEntity $renterPaymentEntity): bool {
        return false;
    }
    public function destroy(int $renterId): bool {
        return false;
    }
}
