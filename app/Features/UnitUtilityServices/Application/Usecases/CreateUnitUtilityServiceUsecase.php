<?php

declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Application\Usecases;

use App\Features\UnitUtilityServices\Application\Contracts\CreateUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Application\Outputs\CreateUnitUtilityServiceOutput;
use App\Shared\Domain\Repositories\UnitRepository;
use Exception;

final class CreateUnitUtilityServiceUsecase implements CreateUnitUtilityServiceContract
{

    public function __construct(
        private readonly UnitRepository $unitRepository,
    ) {}
    public function execute(int $unitId, CreateUnitUtilityServiceOutput $presenter): void
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
}
