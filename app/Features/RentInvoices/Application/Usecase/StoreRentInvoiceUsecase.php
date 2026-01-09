<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Usecase;

use App\Features\RentInvoices\Application\Contracts\StoreRentInvoiceContract;
use App\Features\RentInvoices\Application\Outputs\StoreRentInvoiceOutput;
use App\Shared\Domain\Entities\RentInvoice\RentInvoiceEntity;
use App\Shared\Domain\Repositories\RentInvoiceRepository;
use App\Shared\Domain\Repositories\TransactionRepository;
use App\Shared\Domain\Repositories\UnitContractRepository;
use App\Shared\Infrastructure\Utilities\CarbonDateUtility;
use Exception;

final class StoreRentInvoiceUsecase implements StoreRentInvoiceContract{
    public function __construct(
        private readonly RentInvoiceRepository $rentInvoiceRepository,
        private readonly TransactionRepository $transactionRepository,
        private readonly UnitContractRepository $unitContractRepository,  
    ) { }
    public function execute( RentInvoiceEntity $rentInvoiceEntity , StoreRentInvoiceOutput $presenter): void{
        $transaction = null;
        try {
            // ### calculate rent value for specific month/year ###
            $unitContract = $this->unitContractRepository->show($rentInvoiceEntity->contractId);
            $targetDate = CarbonDateUtility::genereateDate(1, $rentInvoiceEntity->forMonth , $rentInvoiceEntity->forYear);
            $invoiceValue = $unitContract->getCurrentRentValue($targetDate);
            $rentInvoiceEntity->invoiceValue = $invoiceValue;
            //-----------------

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

