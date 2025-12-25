<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Usecase;

use App\Features\RentInvoices\Application\Contracts\CreateRentInvoiceContract;
use App\Features\RentInvoices\Application\Outputs\CreateRentInvoiceOutput;
use App\Shared\Domain\Repositories\UnitContractRepository;
use Exception;

final class CreateRentInvoiceUsecase implements CreateRentInvoiceContract{
    public function __construct(
        private readonly UnitContractRepository $unitContractRepository,
    ) { }
    public function execute(int $unitContractId ,  CreateRentInvoiceOutput $presenter): void{
        try {
            $unitContractEntity = $this->unitContractRepository->show($unitContractId);
            $unitContractEntity
                ? $presenter->onSuccess($unitContractEntity)
                : $presenter->onContractNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}

