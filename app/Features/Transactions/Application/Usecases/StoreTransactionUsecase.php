<?php
declare(strict_types=1);
namespace App\Features\Transactions\Application\Usecases;

use App\Features\Transactions\Application\Contracts\StoreTransactionContract;
use App\Features\Transactions\Application\Outputs\StoreTransactionOutput;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Domain\Repositories\TransactionRepository;
use Exception;

final class StoreTransactionUsecase implements StoreTransactionContract {

    public function __construct(
        private readonly TransactionRepository $transactionRepository,
    ){ }
    /**
     * @inheritDoc
     */
    public function execute ( TransactionEntity $transactionEntity , StoreTransactionOutput $presnter ){
        try {
            $transactionEntity= $this->transactionRepository->store($transactionEntity);
            $presnter->onSuccess($transactionEntity);
        } catch (Exception $e) {
            $presnter->onFailure($e->getMessage()); 
        }
    }
}

