<?php
declare (strict_types=1);
namespace App\Features\Transactions\Application\Usecases;

use App\Features\Transactions\Application\Contracts\ShowTransactionsPaginationContract;
use App\Features\Transactions\Application\Outputs\ShowTransactionsPaginationOutput;
use App\Shared\Domain\Repositories\TransactionRepository;
use Exception;

final class ShowTransactionsPaginationUsecase implements ShowTransactionsPaginationContract {
   public function __construct(
      private readonly TransactionRepository $transactionRepository,
   ){
   }
   public function execute (string $date , ShowTransactionsPaginationOutput $presenter , int $perPage = 10){
      try {
         $entitiesWithPagination = $this->transactionRepository->indexWithPaginationByDate($date, $perPage);
         $balance = $this->transactionRepository->balance();
         $presenter->onSuccess($entitiesWithPagination , $balance);
      } catch (Exception $e) {
         $presenter->onFailure($e->getMessage());
      }
   }
}