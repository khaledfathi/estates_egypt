<?php

declare(strict_types=1);

namespace App\Features\Transactions\Application\Usecases;

use App\Features\Transactions\Application\Contracts\EditTransactionContract;
use App\Features\Transactions\Application\Outputs\EditTransactionOutput;
use App\Shared\Domain\Repositories\TransactionRepository;
use Exception;

final class EditTransactionUsecase implements EditTransactionContract
{
   public function __construct(
      private readonly TransactionRepository $transactionRepository,
   ) {}
   public function execute(int $transactionId, EditTransactionOutput $presenter)
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
