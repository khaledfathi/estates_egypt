<?php

declare(strict_types=1);

namespace App\Features\SharedWaterInvoices\Application\Usecases;

use App\Features\SharedWaterInvoices\Application\Outputs\ShowAllSharedWaterInvoiceOutput;
use App\Shared\Domain\Repositories\SharedWaterInvoiceRepository;

use App\Features\SharedWaterInvoices\Application\Contracts\ShowAllSharedWaterInvoiceContract;
use App\Shared\Domain\Repositories\UnitContractRepository;
use Exception;

final class ShowAllSharedWaterInvoiceUsecase implements ShowAllSharedWaterInvoiceContract
{
    public function __construct(
        private readonly SharedWaterInvoiceRepository $sharedWaterInvoiceRepository,
        private readonly UnitContractRepository $unitContractRepository,
    ) {}
    public function execute(int $unitContractId, int $year, ShowAllSharedWaterInvoiceOutput  $presenter): void
    {
        try {
            $unitContract = $this->unitContractRepository->show($unitContractId);
            $unitContract
                ? $presenter->onSuccess($unitContract , $this->sharedWaterInvoiceRepository->indexByYear($unitContractId , $year))
                : $presenter->onContractNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
