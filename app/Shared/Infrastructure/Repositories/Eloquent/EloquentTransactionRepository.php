<?php
declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Domain\Repositories\TransactionRepository;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Infrastructure\Models\Transaction\Transaction;

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
        $records = Transaction::paginate($perPage);
        dd($records);
        return new EntitiesWithPagination();
    }
    public function show (int $transactionId):TransactionEntity {
        return new TransactionEntity();
    }
    public function store(TransactionEntity $transactionEntity): TransactionEntity{
        $record = Transaction::create([
            'date'=> $transactionEntity->date->toDateString(),
            'amount' => $transactionEntity->amount,
            'description'=> $transactionEntity->description,
        ]);
        $transactionEntity->id = $record->id;
        return $transactionEntity; 
    }
    public function update(TransactionEntity $transactionEntity): bool{
        return false; 
    }
    public function destroy(): bool{
        return false; 
    }
}