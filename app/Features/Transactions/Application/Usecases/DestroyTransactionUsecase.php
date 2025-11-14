<?php
declare (strict_types=1);

namespace  App\Features\Transactions\Application\Usecases;

use App\Features\Transactions\Application\Contracts\DestroyTransactionContract;
use App\Features\Transactions\Application\Outputs\DestroyTransactionOutput;
use App\Shared\Domain\Repositories\TransactionRepository;
use Exception;

final class DestroyTransactionUsecase implements DestroyTransactionContract{
   public function __construct(
      private readonly TransactionRepository $transactionRepository,
   ) { }
   public function execute(int $transactionId , DestroyTransactionOutput $presenter){
      try {
         $status = $this->transactionRepository->destroy($transactionId);
         $presenter->onSuccess($status);
      } catch (Exception $e) {
         $presenter->onFailure($e->getMessage());
      }
   }
} 