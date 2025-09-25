<?php
declare(strict_types=1);

namespace App\Features\Units\Application\Usecases;

use App\Features\Units\Application\Contracts\ShowUnitContract;
use App\Features\Units\Application\Ouputs\ShowUnitOutput;
use App\Features\Units\Application\Ouputs\ShowUnitPaginateOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\UnitRepository;

final class ShowUnitUsecase implements ShowUnitContract
{
    public function __construct(
        private readonly UnitRepository $unitRepository,
        private readonly EstateRepositroy $estateRepositroy,
    ) {}

    public function allWithPaginate(ShowUnitPaginateOutput $presenter, int $estateId, int $perPage = 5): void
    {
        try {
            $unitEntityWithPagination = $this->unitRepository->indexWithPaginate($estateId, $perPage);
            $estateEntity = $this->estateRepositroy->show($estateId);
            if ($estateEntity){
                $presenter->onSuccess($unitEntityWithPagination, $estateEntity);
            } else {
                $presenter->onEstateNotFound();
            }

        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }

    public function showById(int $unitId, ShowUnitOutput $presenter): void {
        try{
            $unitRecord = $this->unitRepository->show($unitId); 
            $unitRecord 
                ?  $presenter->onSuccess( $unitRecord)
                : $presenter->onNotFount();
        }catch (\Exception $e){
            $presenter->onFailure($e->getMessage());
        }
    }
}
