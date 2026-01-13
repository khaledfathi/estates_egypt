<?php

declare(strict_types=1);

namespace App\Features\RentInvoices\Application\Usecase;

use App\Features\RentInvoices\Application\Contracts\ShowAllRentInvoicesContract;
use App\Features\RentInvoices\Application\Outputs\ShowAllRentInvoicesOutput;
use App\Shared\Domain\Repositories\RentInvoiceRepository;
use App\Shared\Domain\Repositories\UnitContractRepository;
use Exception;

class ShowAllRentInvoicesUsecase implements ShowAllRentInvoicesContract
{
    public function __construct(
        private readonly UnitContractRepository $unitContractRepository,
        private readonly RentInvoiceRepository $RentInvoiceRepository,
    ) {}
    public function execute(int $contractId, int $year, ShowAllRentInvoicesOutput $presenter): void
    {
        try {
            $unitContractEntity = $this->unitContractRepository->show($contractId);
            $unitContractEntity
                ? $presenter->onSuccess(
                    $unitContractEntity,
                    $this->RentInvoiceRepository->indexWithPaginateByYear($year,$contractId)
                )
                : $presenter->onContractNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
