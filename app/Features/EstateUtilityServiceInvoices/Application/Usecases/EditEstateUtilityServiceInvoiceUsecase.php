<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServiceInvoices\Application\Usecases;

use App\Features\EstateUtilityServiceInvoices\Application\Contracts\EditEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Application\Outputs\EditEstateUtilityServiceInvoiceOutput;
use App\Shared\Domain\Repositories\EstateUtilityServiceInvoiceRepository;
use Exception;

final class EditEstateUtilityServiceInvoiceUsecase implements EditEstateUtilityServiceInvoiceContract
{

    public function __construct(
        private readonly EstateUtilityServiceInvoiceRepository $estateUtilityServiceInvoiceRepository
    ) {}
    public function execute(int $estateUtilityServiceId, EditEstateUtilityServiceInvoiceOutput $presenter): void
    {
        try {
            $estateUtilityServiceEntity = $this->estateUtilityServiceInvoiceRepository->show($estateUtilityServiceId);
            $estateUtilityServiceEntity
                ? $presenter->onSuccess($estateUtilityServiceEntity)
                : $presenter->onNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
