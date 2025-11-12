<?php

declare(strict_types=1);

namespace App\Features\Transactions\Application\Usecases;

use App\Features\Transactions\Application\Contracts\ShowTransactionContract;
use App\Features\Transactions\Application\Outputs\ShowTransactionOutput;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Domain\Repositories\TransactionRepository;
use Exception;

final class ShowTransactionUsecase implements ShowTransactionContract
{

    public function __construct(
        private readonly TransactionRepository $transactionRepository
    ) {}
    public function execute(int $transactionId, ShowTransactionOutput $presenter): void
    {
        try {
            $record = $this->transactionRepository->show($transactionId);
            $record
                ? $presenter->onSuccess($record)
                : $presenter->onNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
