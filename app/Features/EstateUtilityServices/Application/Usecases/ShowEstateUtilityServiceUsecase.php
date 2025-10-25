<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServices\Application\Usecases;

use App\Features\EstateUtilityServices\Application\Contracts\ShowEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Outputs\ShowEstateUtilityServiceOutput;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\EstateUtilityServiceInvoiceRepository;
use App\Shared\Domain\Repositories\EstateUtilityServiceRepository;
use Exception;

final class ShowEstateUtilityServiceUsecase implements ShowEstateUtilityServiceContract
{
    public function __construct(
        private readonly EstateRepositroy $estateRepositroy,
        private readonly EstateUtilityServiceRepository $estateUtilityServiceRepository,
        private readonly EstateUtilityServiceInvoiceRepository $estateUtilityServiceInvoiceRepository,
    ) {}
    public function execute(int $estateUtilitServiceId, int $invoicesYear, ShowEstateUtilityServiceOutput $presenter): void
    {
        try {
            $estateUtilityServiceEntity = $this->estateUtilityServiceRepository->showWithInvoicesByYear($estateUtilitServiceId , $invoicesYear);
            if ($estateUtilityServiceEntity) {
                $presenter->onSuccess($estateUtilityServiceEntity);
            } else {
                $presenter->onNotFound();
            }
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
