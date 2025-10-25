<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServices\Application\Usecases;

use App\Features\EstateUtilityServices\Application\Contracts\StoreEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Outputs\StoreEstateUtilityServiceOutput;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceEntity;
use App\Shared\Domain\Repositories\EstateUtilityServiceRepository;
use Exception;

final class StoreEstateUtilityServiceUsecase implements StoreEstateUtilityServiceContract
{

    public function __construct(
        private readonly EstateUtilityServiceRepository $estateUtilityServiceRepository,
    ) {}
   public function execute(EstateUtilityServiceEntity $estateUtilityServiceEntity, StoreEstateUtilityServiceOutput $presenter): void
    {
        try {
            $record = $this->estateUtilityServiceRepository->store($estateUtilityServiceEntity);
            $presenter->onSuccess($record);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
