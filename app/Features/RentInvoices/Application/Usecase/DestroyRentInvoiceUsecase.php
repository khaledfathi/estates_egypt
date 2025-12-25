<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Usecase;

use App\Features\RentInvoices\Application\Contracts\DestroyRentInvoiceContract;
use App\Features\RentInvoices\Application\Outputs\DestroyRentInvoiceOutput;
use App\Shared\Domain\Repositories\RentInvoiceRepository;
use Exception;

final class DestroyRentInvoiceUsecase implements DestroyRentInvoiceContract {
    public function __construct(
        private readonly RentInvoiceRepository $rentInvoiceRepository
    ) { }
    public function execute(int $rentInvoiceId, DestroyRentInvoiceOutput $presenter): void{
        try {
           $status = $this->rentInvoiceRepository->destroy($rentInvoiceId);
           $presenter->onSeuccess($status);
        }catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}

