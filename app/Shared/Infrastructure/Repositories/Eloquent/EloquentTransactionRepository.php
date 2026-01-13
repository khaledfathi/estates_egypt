<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Domain\Repositories\TransactionRepository;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Domain\ValueObjects\Pagination;
use App\Shared\Infrastructure\Models\Transaction\Transaction;
use App\Shared\Infrastructure\Utilities\CarbonDateUtility;

final class EloquentTransactionRepository implements TransactionRepository
{
    /**
     * @inheritDoc
     */
    public function index(): array
    {
        return [];
    }
    /**
     * @inheritDoc
     */
    public function indexWithPaginationByDate(string $date, int $perPage): EntitiesWithPagination
    {

        $transactionRecords = Transaction::with(['rentInvoices', 'sharedWaterInvoices'])->where('date', $date)
            ->whereDoesntHave('rentInvoices')
            ->whereDoesntHave('sharedWaterInvoices')
            ->whereDoesntHave('estateMaintenanceExpenses')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        //transaction entities DTO 
        $transactionEntitites = [];
        foreach ($transactionRecords as $record) {
            $transaction = new  TransactionEntity(
                id: $record['id'],
                date: CarbonDateUtility::from($record['date']),
                amount: $record['amount'],
                description: $record['description'],
            );
            $transaction->setDirection(); // set value of transaction to be ( withdraw or deposit)
            $transactionEntitites[] = $transaction;
        }
        //Pagination DTO
        $paginationData = new Pagination(
            perPage: $transactionRecords->perPage(),
            currentPage: $transactionRecords->currentPage(),
            path: $transactionRecords->path(),
            pageName: $transactionRecords->getPageName(),
            total: $transactionRecords->total(),
        );
        return new EntitiesWithPagination(
            $paginationData,
            $transactionEntitites,
        );
    }
    public function show(int $transactionId): TransactionEntity | null
    {
        $record = Transaction::find($transactionId);
        if ($record) {
            $transactionEntity = new TransactionEntity(
                id: $record->id,
                date: CarbonDateUtility::from($record->date),
                amount: $record->amount,
                description: $record->description,
            );
            $transactionEntity->setDirection();
            return $transactionEntity;
        }
        return null;
    }
    public function store(TransactionEntity $transactionEntity): TransactionEntity
    {
        $record = Transaction::create([
            'date' => $transactionEntity->date->toDateString(),
            'amount' => $transactionEntity->amount,
            'description' => $transactionEntity->description,
        ]);
        $transactionEntity->id = $record->id;
        return $transactionEntity;
    }
    public function update(TransactionEntity $transactionEntity): bool
    {
        $data = [];
        if ($transactionEntity->date != null)  $data['date'] = $transactionEntity->date->toDateString();
        if ($transactionEntity->amount != null)  $data['amount'] = $transactionEntity->amount;
        if ($transactionEntity->description != null)  $data['description'] = $transactionEntity->description;
        return Transaction::find($transactionEntity->id)->update($data);
    }
    public function destroy(int $transactionId): bool
    {
        return Transaction::find($transactionId)->delete();
    }
    public function destroyMany (array $transactionsIds): int{
        return Transaction::destroy($transactionsIds);
    }
    public function balance(): int
    {
        return Transaction::sum('amount');
    }
}
