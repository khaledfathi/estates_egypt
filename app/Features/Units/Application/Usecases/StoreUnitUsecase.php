<?php

declare(strict_types=1);

namespace App\Features\Units\Application\Usecases;

use App\Features\Units\Application\Contracts\StoreUnitContract;
use App\Features\Units\Application\DTOs\UnitFormDTO;
use App\Features\Units\Application\Ouputs\CreateUnitOutput;
use App\Features\Units\Application\Ouputs\StoreUnitOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\Enum\Unit\UnitIsEmpty;
use App\Shared\Domain\Enum\Unit\UnitOwnershipType;
use App\Shared\Domain\Enum\Unit\UnitType;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\UnitRepository;
use Exception;

final class StoreUnitUsecase implements StoreUnitContract
{
    public function __construct(
        private readonly EstateRepositroy $estateRepositroy,
        private readonly UnitRepository $unitRepository,
    ) {}
    public function create(int $estateId, CreateUnitOutput $presenter)
    {
        try {
            $estate = $this->estateRepositroy->show($estateId);
            $unitTypes = UnitType::labels();
            $unitOwnershipTypes = UnitOwnershipType::labels();
            $unitIsEmptyLabels = UnitIsEmpty::labels();
            $unitFormDTO = new UnitFormDTO(
                $estate,
                $unitTypes,
                $unitOwnershipTypes,
                $unitIsEmptyLabels
            );
            $presenter->onSuccess($unitFormDTO);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }

    public function store(UnitEntity $unitEntity, StoreUnitOutput $presenter)
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
