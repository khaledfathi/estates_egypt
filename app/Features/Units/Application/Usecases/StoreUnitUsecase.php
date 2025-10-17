<?php

declare(strict_types=1);

namespace App\Features\Units\Application\Usecases;

use App\Features\Units\Application\Contracts\StoreUnitContract;
use App\Features\Units\Application\Ouputs\StoreUnitOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\UnitRepository;
use Exception;

final class StoreUnitUsecase implements StoreUnitContract
{
    public function __construct(
        private readonly EstateRepositroy $estateRepositroy,
        private readonly UnitRepository $unitRepository,
    ) {}
    public function execute(UnitEntity $unitEntity, StoreUnitOutput $presenter):void
    {
        try {
            $unitEntity = $this->unitRepository->store($unitEntity);
            $unitEntity->estate =  $this->estateRepositroy->show($unitEntity->estateId);
            $presenter->onSuccess($unitEntity);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
