<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Usecase;

use App\Features\RentInvoices\Application\Contracts\DestroyRentInvoiceContract;
use App\Features\RentInvoices\Application\Outputs\DestroyRentInvoiceOutput;
use App\Shared\Domain\Repositories\RentInvoiceRepository;
use App\Shared\Domain\Repositories\TransactionRepository;
use Exception;

final class DestroyRentInvoiceUsecase implements DestroyRentInvoiceContract {
    public function __construct(
        private readonly RentInvoiceRepository $rentInvoiceRepository,
        private readonly TransactionRepository $transactionRepository, 
    ) { }
    public function execute(int $rentInvoiceId, DestroyRentInvoiceOutput $presenter): void{
        try {
           $rentInvoiceEntity= $this->rentInvoiceRepository->show($rentInvoiceId);
           $status =  $this->transactionRepository->destroy($rentInvoiceEntity->transactionId);
           $presenter->onSeuccess($status);
        }catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}

