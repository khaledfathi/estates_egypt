<?php

declare(strict_types=1);

namespace App\Features\UnitOwnerships\Application\Usecases;

use App\Features\UnitOwnerships\Application\Contracts\StoreUnitOwnershipContract;
use App\Features\UnitOwnerships\Application\Outputs\CreateUnitOwnershipOutput;
use App\Features\UnitOwnerships\Application\Outputs\StoreUnitOwnershipOutput;
use App\Shared\Domain\Entities\Unit\UnitOwnershipEntity;
use App\Shared\Domain\Repositories\OwnerRepository;
use App\Shared\Domain\Repositories\UnitOwnershipRepository;
use App\Shared\Domain\Repositories\UnitRepository;
use Exception;

final class StoreUnitOwnershipUsecase implements StoreUnitOwnershipContract
{
    public function __construct(
        private readonly UnitOwnershipRepository $unitOwnershipRepository,
        private readonly UnitRepository $unitRepository,
        private readonly OwnerRepository $ownerRepository
    ) {}
    public function create(int $unitId, CreateUnitOwnershipOutput $presnter): void
    {
        try {
            $unitEntity = $this->unitRepository->show($unitId);
            $ownerEntities= $this->ownerRepository->index();
            if($unitEntity){
                 $unitEntity->owners = $ownerEntities;
                 $presnter->onSuccess($unitEntity);
            }else{
                $presnter->onUnitNotFound();
            }
        } catch (Exception $e) {
            $presnter->onFailure($e->getMessage());
        }
    }
    public function store (UnitOwnershipEntity $unitOwnershipEntity, StoreUnitOwnershipOutput $presnter): void
    {
        try {
            $record = $this->unitOwnershipRepository->store($unitOwnershipEntity);
            $presnter->onSuccess($record);
        } catch (Exception $e) {
            $presnter->onFailure($e->getMessage());
        }
    }

}
