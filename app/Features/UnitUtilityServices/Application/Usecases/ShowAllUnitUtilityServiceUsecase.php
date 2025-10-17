<?php

declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Application\Usecases;

use App\Features\UnitUtilityServices\Application\Contracts\ShowAllUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Application\Outputs\ShowAllUnitUtilityServicesOutput;
use App\Shared\Domain\Repositories\UnitRepository;
use App\Shared\Domain\Repositories\UnitUtilityServiceRepository;
use Exception;

final class ShowAllUnitUtilityServiceUsecase implements ShowAllUnitUtilityServiceContract
{

    public function __construct(
        private readonly UnitUtilityServiceRepository $unitUtilityServiceRepository,
        private readonly UnitRepository $unitRepository,
    ) {}
    public function execute(int $unitId, ShowAllUnitUtilityServicesOutput $presenter): void
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
}
