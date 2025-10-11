<?php

declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Application\Usecases;

use App\Features\UnitUtilityServices\Application\Contracts\ShowUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Application\Outputs\ShowAllUnitUtilityServicesOutput;
use App\Features\UnitUtilityServices\Application\Outputs\ShowUnitUtilityServiceOutput;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\UnitRepository;
use App\Shared\Domain\Repositories\UnitUtilityServiceRepository;
use App\Shared\Infrastructure\Models\Unit\UnitUtilityService;
use Exception;

final class ShowUnitUtilityServiceUsecase implements ShowUnitUtilityServiceContract
{

    public function __construct(
        private readonly UnitUtilityServiceRepository $unitUtilityServiceRepository,
        private readonly UnitRepository $unitRepository,
        private readonly EstateRepositroy $estateRepositroy,
    ) {}
    public function all(int $unitId, ShowAllUnitUtilityServicesOutput $presenter): void
    {
        try {
            $unitEntity = $this->unitRepository->show($unitId);
            if ($unitEntity) {
                $unitUtilityServicesEntities =  $this->unitUtilityServiceRepository->index($unitId);
                $presenter->onSuccess($unitEntity, $unitUtilityServicesEntities);
            } else {
                $presenter->onNotFound();
            }
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
    public function showById(int $unitUtilitServiceId, ShowUnitUtilityServiceOutput $presenter): void
    {
        try {
            $unitUtilitServiceEntity = $this->unitUtilityServiceRepository->show($unitUtilitServiceId);
            if ($unitUtilitServiceEntity) {
                $presenter->onSuccess($unitUtilitServiceEntity);
            } else {

                $presenter->onNotFound();
            }
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
