<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Usecase;

use App\Features\RentInvoices\Application\Contracts\UpdateRentInvoiceContract;
use App\Features\RentInvoices\Application\Outputs\UpdateRentInvoiceOutput;
use App\Shared\Domain\Entities\RentInvoice\RentInvoiceEntity;
use App\Shared\Domain\Repositories\RentInvoiceRepository;
use App\Shared\Domain\Repositories\TransactionRepository;
use Exception;

final class UpdateRentInvoiceUsecase implements UpdateRentInvoiceContract{
    public function __construct(
        private readonly RentInvoiceRepository $rentInvoiceRepository,
        private readonly TransactionRepository $transactionRepository, 
    ) { }
    public function execute(RentInvoiceEntity $rentInvoiceEntity ,UpdateRentInvoiceOutput $presenter): void{
        try {
            $transactionStatus = $this->transactionRepository->update($rentInvoiceEntity->transaction);
            $rentInvoiceStatus = $this->rentInvoiceRepository->update($rentInvoiceEntity);
            $presenter->onSuccess($rentInvoiceStatus);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}

