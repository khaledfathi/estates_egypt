<?php

declare(strict_types=1);

namespace App\Features\Units\Application\Usecases;

use App\Features\Units\Application\Contracts\UpdateUnitContract;
use App\Features\Units\Application\DTOs\UnitFormDTO;
use App\Features\Units\Application\Ouputs\EditUnitOutput;
use App\Features\Units\Application\Ouputs\UpdateUnitOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\Enum\Unit\UnitIsEmpty;
use App\Shared\Domain\Enum\Unit\UnitType;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\UnitRepository;
use Exception;

final class UpdateUnitUsecase implements UpdateUnitContract
{

    public function __construct(
        private readonly UnitRepository $unitRepository,
        private readonly EstateRepositroy $estateRepositroy
    ) {}
    public function edit(int $unitId, EditUnitOutput $presenter): void
    {
        try {
            //unit record 
            $unitEntity = $this->unitRepository->show($unitId);
            if (!$unitEntity) {
                $presenter->onNotFound();
                return;
            }
            $estateEntity = $this->estateRepositroy->show($unitEntity?->estate->id);
            $unitTypes = UnitType::labels();
            $unitIsEmptyLabels = UnitIsEmpty::labels();
            $unitFormDTO = new UnitFormDTO(
                $estateEntity,
                $unitTypes,
                $unitIsEmptyLabels
            );
            $presenter->onSuccess($unitFormDTO, $unitEntity);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
    public function update (UnitEntity $unitEntity, UpdateUnitOutput $presenter): void{
        try {
            $presenter->onSuccess( $this->unitRepository->update($unitEntity), $unitEntity);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
