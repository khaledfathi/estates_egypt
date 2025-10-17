<?php

declare(strict_types=1);

namespace App\Features\Units\Application\Usecases;

use App\Features\Units\Application\Contracts\DestroyUnitContract;
use App\Features\Units\Application\Ouputs\DestroyUnitOutput;
use App\Shared\Domain\Repositories\UnitRepository;

final class  DestroyUnitUsecase implements DestroyUnitContract
{
    public function __construct(
        private readonly UnitRepository $unitRepository,
    ) {}
    public function execute(int $unitId, DestroyUnitOutput $presenter): void
    {
        try {
            $destroyUnitStatus= $this->unitRepository->destroy($unitId) ;
            $presenter->onSuccess($destroyUnitStatus );
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
