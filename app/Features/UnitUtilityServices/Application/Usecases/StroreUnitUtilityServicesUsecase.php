<?php

declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Application\Usecases;

use App\Features\UnitUtilityServices\Application\Contracts\StoreUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Application\Outputs\StoreUnitUtilityServiceOutput;
use App\Shared\Domain\Entities\Unit\UnitUtilityServiceEntity;
use App\Shared\Domain\Repositories\UnitUtilityServiceRepository;
use Exception;

final class StroreUnitUtilityServicesUsecase implements StoreUnitUtilityServiceContract
{

    public function __construct(
        private readonly UnitUtilityServiceRepository $unitUtilityServiceRepository,
    ) {}
    public function execute(UnitUtilityServiceEntity $unitUtilityServiceEntity, StoreUnitUtilityServiceOutput $presenter): void
    {
        try {
            $record = $this->unitUtilityServiceRepository->store($unitUtilityServiceEntity);
            $unitUtilityServiceEntity->id = $record->id;
            $presenter->onSuccess($unitUtilityServiceEntity);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
