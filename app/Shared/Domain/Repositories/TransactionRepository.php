<?php
declare(strict_types=1);

namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use TransactionEntity;

interface TransactionRepository
{
    /**
     * @return array<TransactionEntity>
     */
    public function index(): array;
    /**
     * @return EntitiesWithPagination<TransactionEntity>
     */
    public function indexWithPagination(int $perPage): EntitiesWithPagination;
    public function store(): TransactionEntity;
    public function update(): bool;
    public function destroy(): bool;
}
