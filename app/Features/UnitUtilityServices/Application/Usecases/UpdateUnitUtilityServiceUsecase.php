<?php

declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Application\Usecases;

use App\Features\UnitUtilityServices\Application\Contracts\UpdateUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Application\Outputs\UpdateUnitUtilityServiceOutput;
use App\Shared\Domain\Entities\Unit\UnitUtilityServiceEntity;
use App\Shared\Domain\Repositories\UnitUtilityServiceRepository;
use Exception;

final class UpdateUnitUtilityServiceUsecase implements UpdateUnitUtilityServiceContract
{
    public function __construct(
        private readonly UnitUtilityServiceRepository $unitUtilityServiceRepository
    ) {}
    public function execute(UnitUtilityServiceEntity $unitUtilityServiceEntity, UpdateUnitUtilityServiceOutput $presenter): void
    {
        try {
            $record =  $this->unitUtilityServiceRepository->update($unitUtilityServiceEntity);
            $presenter->onSuccess($record);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
