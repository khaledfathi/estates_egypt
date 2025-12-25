<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Usecase;

use App\Features\RentInvoices\Application\Contracts\StoreRentInvoiceContract;
use App\Features\RentInvoices\Application\Outputs\StoreRentInvoiceOutput;
use App\Shared\Domain\Entities\RentsPayment\RentInvoiceEntity;
use App\Shared\Domain\Repositories\RentInvoiceRepository;
use App\Shared\Domain\Repositories\TransactionRepository;
use App\Shared\Infrastructure\Models\Transaction\Transaction;
use Exception;

final class StoreRentInvoiceUsecase implements StoreRentInvoiceContract{
    public function __construct(
        private readonly RentInvoiceRepository $rentInvoiceRepository,
        private readonly TransactionRepository $transactionRepository,
    ) { }
    public function execute( RentInvoiceEntity $rentInvoiceEntity , StoreRentInvoiceOutput $presenter): void{
        $transaction = null;
        try {
            $transaction = $this->transactionRepository->store($rentInvoiceEntity->transaction);
            $rentInvoiceEntity->transaction = $transaction;
            $record = $this->rentInvoiceRepository->store($rentInvoiceEntity);
            $presenter->onSuccess($record);
        } catch (Exception $e) {
            if ($transaction){
                $this->transactionRepository->destroy($transaction->id);
            }
            $presenter->onFailure($e->getMessage());
        }
    }
}

