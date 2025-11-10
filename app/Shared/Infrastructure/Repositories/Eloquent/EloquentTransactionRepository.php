<?php
declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Shared\Domain\Repositories\TransactionRepository;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use TransactionEntity;

final class EloquentTransactionRepository implements TransactionRepository{
    /**
     * @inheritDoc
     */
    public function index(): array{
        return [];
    }
    /**
     * @inheritDoc
     */
    public function indexWithPagination(int $perPage): EntitiesWithPagination{
        return new EntitiesWithPagination();
    }
    public function store(): TransactionEntity{
        return new TransactionEntity();
    }
    public function update(): bool{
        return false; 
    }
    public function destroy(): bool{
        return false; 
    }
}