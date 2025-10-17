<?php

declare(strict_types=1);

namespace App\Features\UnitOwnerships\Application\Usecases;

use App\Features\UnitOwnerships\Application\Contracts\CreateUnitOwnershipContract;
use App\Features\UnitOwnerships\Application\Outputs\CreateUnitOwnershipOutput;
use App\Shared\Domain\Repositories\OwnerRepository;
use App\Shared\Domain\Repositories\UnitRepository;
use Exception;

final class CreateUnitOwnershipUsecase implements CreateUnitOwnershipContract
{

    public function __construct(
        private readonly UnitRepository $unitRepository,
        private readonly OwnerRepository $ownerRepository
    ) {}
    public function execute(int $unitId, CreateUnitOwnershipOutput $presnter): void
    {
        try {
            $unitEntity = $this->unitRepository->show($unitId);
            $ownerEntities = $this->ownerRepository->index();
            if ($unitEntity) {
                $unitEntity->owners = $ownerEntities;
                $presnter->onSuccess($unitEntity);
            } else {
                $presnter->onUnitNotFound();
            }
        } catch (Exception $e) {
            $presnter->onFailure($e->getMessage());
        }
    }
}
