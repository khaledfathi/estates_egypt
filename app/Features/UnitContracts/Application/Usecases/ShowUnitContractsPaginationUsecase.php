<?php

declare(strict_types=1);

namespace App\Features\UnitContracts\Application\Usecases;

use App\Features\UnitContracts\Application\Contracts\ShowUnitContractsPaginationContract;
use App\Features\UnitContracts\Application\Ouputs\ShowUnitContractsPaginationOutput;
use App\Shared\Domain\Repositories\UnitContractRepository;
use App\Shared\Domain\Repositories\UnitRepository;
use Exception;

final class ShowUnitContractsPaginationUsecase implements ShowUnitContractsPaginationContract
{

    public function __construct(
        private readonly UnitContractRepository $unitContractRepository,
        private readonly UnitRepository $unitRepository,
    ) {}
    public function execute(int $unitId, ShowUnitContractsPaginationOutput $presenter, $perPage = 10): void
    {
        try {
            $unitEntity = $this->unitRepository->show($unitId);
            if ($unitEntity) {
                $EntitiesWithPagination  = $this->unitContractRepository->indexWithPaginateByUnitId($unitId, $perPage);
                $presenter->onSuccess($unitEntity, $EntitiesWithPagination);
            } else {
                $presenter->onUnitNotFound();
            }
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
