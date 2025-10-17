<?php

declare(strict_types=1);

namespace App\Features\Owners\Application\Usecases;

use App\Features\Owners\Application\Contracts\UpdateOwnerContract;
use App\Features\Owners\Application\Outputs\EditOwnerOutput;
use App\Features\Owners\Application\Outputs\UpdateOwnerOutput;
use App\Shared\Domain\Entities\Owner\OwnerEntity;
use App\Shared\Domain\Repositories\OwnerGroupRepository;
use App\Shared\Domain\Repositories\OwnerInGroupRepository;
use App\Shared\Domain\Repositories\OwnerRepository;

final class UpdateOwnerUsecase implements UpdateOwnerContract
{
    public function __construct(
        private readonly OwnerRepository $ownerRepository,
        private readonly OwnerGroupRepository $ownerGroupRepository,
        private readonly OwnerInGroupRepository $ownerInGroupRepository
    ) {}
    public function edit(int $ownerId, EditOwnerOutput $presenter): void
    {
        try {
            $record = $this->ownerRepository->show($ownerId);
            if ($record) {
                $ownerGroupEnitites = $this->ownerGroupRepository->index();
                $presenter->onSuccess($record, $ownerGroupEnitites);
            } else {
                $presenter->onNotFound();
            }
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
    public function update(OwnerEntity $ownerEntity, UpdateOwnerOutput $presenter): void
    {
        try {
            // unlink all groups for this owner  
            $this->ownerInGroupRepository->destroyWhereOwnerId($ownerEntity->id);
            // link updated groups to this owner
            $this->ownerInGroupRepository->storeManyGroups(
                $ownerEntity->id,
                array_map(fn($ownerGroup) => $ownerGroup->id, $ownerEntity->ownerGroups)
            );
            //on success
            $presenter->onSuccess($this->ownerRepository->update($ownerEntity));
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
