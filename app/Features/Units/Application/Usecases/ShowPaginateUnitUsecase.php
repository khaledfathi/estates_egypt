<?php

declare(strict_types=1);

namespace App\Features\Units\Application\Usecases;

use App\Features\Units\Application\Contracts\ShowPaginateUnitContract;
use App\Features\Units\Application\Ouputs\ShowUnitPaginateOutput;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\UnitRepository;

final class ShowPaginateUnitUsecase implements ShowPaginateUnitContract
{
    public function __construct(
        private readonly UnitRepository $unitRepository,
        private readonly EstateRepositroy $estateRepositroy,
    ) {}
    public function execute(ShowUnitPaginateOutput $presenter, int $estateId, int $perPage = 5): void
    {
        try {
            $unitEntityWithPagination = $this->unitRepository->indexWithPaginate($estateId, $perPage);
            $estateEntity = $this->estateRepositroy->show($estateId);
            if ($estateEntity) {
                $presenter->onSuccess($unitEntityWithPagination, $estateEntity);
            } else {
                $presenter->onEstateNotFound();
            }
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
