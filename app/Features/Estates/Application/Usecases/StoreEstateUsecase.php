<?php

declare(strict_types=1);

namespace App\Features\Estates\Application\Usecases;

use App\Features\Estates\Application\Contracts\StoreEstateContract;
use App\Features\Estates\Application\Outputs\StoreEstateOutput;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\Enum\Unit\UnitType;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\UnitRepository;

final class StoreEstateUsecase implements StoreEstateContract
{
    public function __construct(
        private readonly EstateRepositroy $estateRepositroy,
        private readonly UnitRepository $unitRepository
    ) {}
    /**
     * 
     * @inheritDoc
     */
    public function execute(EstateEntity $estateEntity, StoreEstateOutput $presenter): void
    {
        try {
            //store estate
            $estateEntity = $this->estateRepositroy->store($estateEntity);
            //create units for estate
            $units = [];
            //create residential units  
            for ($i = 0; $i < $estateEntity->residentialUnitCount; $i++) {
                $units[] = $this->unitRepository->store(
                    new UnitEntity(
                        estateId: $estateEntity->id,
                        number: $i + 1,
                        floorNumber: 0,
                        type: UnitType::RESDENTIAL,
                        isEmpty: true,
                    )
                );
            }
            //create commercial units 
            for ($i = 0; $i < $estateEntity->commercialUnitCount; $i++) {
                $units[] = $this->unitRepository->store(
                    new UnitEntity(
                        estateId: $estateEntity->id,
                        number: $i + 1,
                        floorNumber: 0,
                        type: UnitType::COMMERCIAL,
                        isEmpty: true,
                    )
                );
            }
            $estateEntity->units = $units;
            $presenter->onSuccess($estateEntity);
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
