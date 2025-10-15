<?php

declare(strict_types=1);

namespace App\Features\OwnerGroups\Application\Usecases;

use App\Features\OwnerGroups\Application\Contracts\DestroyOwnerGroupContract;
use App\Features\OwnerGroups\Application\Outputs\DestroyOwnerGroupOutput;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Domain\Repositories\OwnerGroupRepository;
use Exception;

final class DestroyOwnerGroupUsecase implements DestroyOwnerGroupContract
{
    public function __construct(
        private readonly OwnerGroupRepository $ownerGroupRepository,
    ) {}
    public function destroy(int $ownerGroupId, DestroyOwnerGroupOutput $presneter): void
    {
        try {
            $presneter->onSuccess($this->ownerGroupRepository->destroy($ownerGroupId));
        } catch (Exception $e) {
            $presneter->onFailure($e->getMessage());
        }
    }
}
