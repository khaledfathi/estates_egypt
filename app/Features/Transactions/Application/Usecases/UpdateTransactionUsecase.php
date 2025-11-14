<?php

declare(strict_types=1);

namespace App\Features\Transactions\Application\Usecases;

use App\Features\Transactions\Application\Contracts\UpdateTransactionContract;
use App\Features\Transactions\Application\Outputs\UpdateTransactionOutput;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Domain\Repositories\TransactionRepository;
use Exception;

use function PHPUnit\Framework\throwException;

final class UpdateTransactionUsecase implements UpdateTransactionContract
{
   public function __construct(
      private readonly TransactionRepository $transactionRepository,
   ) {}
   public function execute(TransactionEntity $transactionEntity, UpdateTransactionOutput $presenter)
   {
      try {
         $status = $this->transactionRepository->update($transactionEntity);
         $presenter->onSuccess($status);
      } catch (Exception $e) {
         $presenter->onFailure($e->getMessage());
      }
   }
}
