<?php

declare(strict_types=1);

namespace App\Features\OwnerGroups\Application\Usecases;

use App\Features\OwnerGroups\Application\Contracts\UpdateOwnerGroupContrat;
use App\Features\OwnerGroups\Application\Outputs\EditOwnerGroupsOutput;
use App\Features\OwnerGroups\Application\Outputs\UpdateOwnerGroupOutput;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Domain\Repositories\OwnerGroupRepository;
use Exception;

final class UpdateOwnerGroupUsecase implements UpdateOwnerGroupContrat
{

    public function __construct(
        private readonly OwnerGroupRepository $ownerGroupRepository
    ) {}
    public function edit(int $ownerGroupId, EditOwnerGroupsOutput $presneter): void
    {
        try {
            $record = $this->ownerGroupRepository->show($ownerGroupId);
            $record
                ? $presneter->onSuccess($record)
                : $presneter->onNotFound();
        } catch (Exception $e) {
            $presneter->onFailure($e->getMessage());
        }
    }
    public function update(OwnerGroupEntity $ownerGroupEntity, UpdateOwnerGroupOutput $presneter): void
    {
        try {
            $status = $this->ownerGroupRepository->update($ownerGroupEntity);
            $presneter->onSuccess($status);
        } catch (Exception $e) {
            $presneter->onFailure($e->getMessage());
        }
    }
}
