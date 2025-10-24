<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServiceInvoices\Application\Usecases;

use App\Features\EstateUtilityServiceInvoices\Application\Contracts\CreateEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Application\Outputs\CreateEstateUtilityServiceInvoiceOutput;
use App\Shared\Domain\Repositories\EstateUtilityServiceRepository;
use Exception;

final class CreateEstateUtilityServiceInvoiceUsecase implements CreateEstateUtilityServiceInvoiceContract
{
    public function __construct(
        private readonly EstateUtilityServiceRepository $estateUtilityServiceRepository,
    ) {}
    public function execute(int $estateUtilityServiceId ,CreateEstateUtilityServiceInvoiceOutput $presenter): void
    {
        try {
            $estateUtilityServiceEntity  =$this->estateUtilityServiceRepository->show($estateUtilityServiceId);
            $estateUtilityServiceEntity
                ? $presenter->onSuccess($estateUtilityServiceEntity)
                : $presenter->onNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
