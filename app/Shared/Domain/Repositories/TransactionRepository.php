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
    public function show (int $transactionId):TransactionEntity|null ;
    public function indexWithPaginationByDate(string $date , int $perPage): EntitiesWithPagination;
    public function store(TransactionEntity $transactionEntity): TransactionEntity;
    public function update(TransactionEntity $transactionEntity): bool;
    public function destroy(int $transactionId): bool;
    // ----
    public function balance ():int;
}
