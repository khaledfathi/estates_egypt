<?php

declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Application\Usecases;

use App\Features\UnitUtilityServices\Application\Contracts\StoreUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Application\Outputs\CreateUnitUtilityServiceOutput;
use App\Features\UnitUtilityServices\Application\Outputs\StoreUnitUtilityServiceOutput;
use App\Shared\Domain\Entities\Unit\UnitUtilityServiceEntity;
use App\Shared\Domain\Repositories\UnitRepository;
use App\Shared\Domain\Repositories\UnitUtilityServiceRepository;
use Exception;

final class StroreUnitUtilityServicesUsecase implements StoreUnitUtilityServiceContract
{

    public function __construct(
        private readonly UnitRepository $unitRepository,
        private readonly UnitUtilityServiceRepository $unitUtilityServiceRepository,
    ) {}
    public function create(int $unitId, CreateUnitUtilityServiceOutput $presenter): void
    {
        try {
            $unitEntity = $this->unitRepository->show($unitId);
            $unitEntity
                ? $presenter->onSuccess($unitEntity)
                : $presenter->onNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
    public function store(UnitUtilityServiceEntity $unitUtilityServiceEntity, StoreUnitUtilityServiceOutput $presenter): void
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
