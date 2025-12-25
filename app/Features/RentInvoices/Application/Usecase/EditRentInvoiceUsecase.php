<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Usecase;

use App\Features\RentInvoices\Application\Contracts\EditRentInvoiceContract;
use App\Features\RentInvoices\Application\Outputs\EditRentInvoiceOutput;
use App\Shared\Domain\Repositories\RentInvoiceRepository;
use Exception;

class EditRentInvoiceUsecase implements EditRentInvoiceContract {
    public function __construct(
        private readonly RentInvoiceRepository $rentInvoiceRepository,
    ) { }
    public function execute(int $rentInvoiceId, EditRentInvoiceOutput  $presenter): void{
        try{
            $rentInvoiceEntity = $this->rentInvoiceRepository->show($rentInvoiceId);
            $rentInvoiceEntity
                ? $presenter->onSuccess($rentInvoiceEntity)
                : $presenter->onNotFound();
        }catch (Exception $e){
            $presenter->onFailure($e->getMessage());
        }
    }
}

