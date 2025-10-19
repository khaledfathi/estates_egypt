<?php

declare(strict_types=1);

namespace App\Features\UnitOwnerships\Application\Usecases;

use App\Features\UnitOwnerships\Application\Contracts\StoreUnitOwnershipsByOwnerGoupsContract;
use App\Features\UnitOwnerships\Application\DTOs\OwnershipByOwnersGroupsDTO;
use App\Features\UnitOwnerships\Application\Outputs\StoreUnitOwnershipsOutput;
use App\Shared\Domain\Repositories\OwnerGroupRepository;
use App\Shared\Domain\Repositories\UnitOwnershipRepository;
use Exception;

final class StoreUnitOwnershipsByOwnerGoupsUsecase implements StoreUnitOwnershipsByOwnerGoupsContract
{

    public function __construct(
        private readonly UnitOwnershipRepository $unitOwnershipRepository,
        private readonly OwnerGroupRepository $ownerGroupRepository ,
    ) {}
    public function execute(OwnershipByOwnersGroupsDTO $ownershipByOwnersGroupsDTO, StoreUnitOwnershipsOutput $presnter): void
    {
        try {
            $ownersIds = $this->ownerGroupRepository->getOwnersIds($ownershipByOwnersGroupsDTO->groupsIds);
            $unitOwnershipEntitites = $this->unitOwnershipRepository->storeManyOwners($ownershipByOwnersGroupsDTO->unitId , $ownersIds);
            $presnter->onSuccess($unitOwnershipEntitites);
        } catch (Exception $e) {
            $presnter->onFailure($e->getMessage());
        }
    }
}
