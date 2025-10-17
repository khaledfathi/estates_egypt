<?php

declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Application\Usecases;

use App\Features\UnitUtilityServices\Application\Contracts\ShowUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Application\Outputs\ShowUnitUtilityServiceOutput;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\UnitRepository;
use App\Shared\Domain\Repositories\UnitUtilityServiceRepository;
use Exception;

final class ShowUnitUtilityServiceUsecase implements ShowUnitUtilityServiceContract
{

    public function __construct(
        private readonly UnitUtilityServiceRepository $unitUtilityServiceRepository,
        private readonly UnitRepository $unitRepository,
        private readonly EstateRepositroy $estateRepositroy,
    ) {}
    public function execute(int $unitUtilitServiceId, ShowUnitUtilityServiceOutput $presenter): void
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
