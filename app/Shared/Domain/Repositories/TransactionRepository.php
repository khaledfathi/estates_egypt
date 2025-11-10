<?php
declare(strict_types=1);

namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface TransactionRepository
{
    /**
     * @return array<TransactionEntity>
     */
    public function index(): array;
    /**
     * @return EntitiesWithPagination<TransactionEntity>
     */
    public function show (int $transactionId):TransactionEntity ;
    public function indexWithPagination(int $perPage): EntitiesWithPagination;
    public function store(TransactionEntity $transactionEntity): TransactionEntity;
    public function update(TransactionEntity $transactionEntity): bool;
    public function destroy(): bool;
}
