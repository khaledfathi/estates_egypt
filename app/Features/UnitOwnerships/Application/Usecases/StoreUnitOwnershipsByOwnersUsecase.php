<?php

declare(strict_types=1);

namespace App\Features\UnitOwnerships\Application\Usecases;

use App\Features\UnitOwnerships\Application\Contracts\StoreUnitOwnershipsByOwnersContract;
use App\Features\UnitOwnerships\Application\DTOs\OwnershipByOwnersFormDTO;
use App\Features\UnitOwnerships\Application\Outputs\StoreUnitOwnershipsOutput;
use App\Shared\Domain\Repositories\UnitOwnershipRepository;
use Exception;

final class StoreUnitOwnershipsByOwnersUsecase implements StoreUnitOwnershipsByOwnersContract
{

    public function __construct(
        private readonly UnitOwnershipRepository $unitOwnershipRepository
    ) {}
    public function execute (OwnershipByOwnersFormDTO $ownershipByOwnersFormDTO, StoreUnitOwnershipsOutput $presnter): void
    {
        try {
            $presnter->onSuccess(
                $this->unitOwnershipRepository->storeManyOwners($ownershipByOwnersFormDTO->unitId , $ownershipByOwnersFormDTO->ownersIds)
            );

        } catch (Exception $e) {
            $presnter->onFailure($e->getMessage());
        }
    }
}
