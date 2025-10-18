<?php

declare(strict_types=1);

namespace App\Features\Units\Application\Usecases;

use App\Features\Units\Application\Contracts\UpdateUnitContract;
use App\Features\Units\Application\Ouputs\UpdateUnitOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\Repositories\UnitRepository;
use Exception;

final class UpdateUnitUsecase implements UpdateUnitContract
{

    public function __construct(
        private readonly UnitRepository $unitRepository,
    ) {}
    public function execute (UnitEntity $unitEntity, UpdateUnitOutput $presenter): void{
        try {
            $presenter->onSuccess( $this->unitRepository->update($unitEntity), $unitEntity);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
