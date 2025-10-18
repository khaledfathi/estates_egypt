<?php

declare(strict_types=1);

namespace App\Features\Owners\Application\Usecases;

use App\Features\Owners\Application\Contracts\StoreOwnerContract;
use App\Features\Owners\Application\Outputs\StoreOwnerOutput;
use App\Shared\Domain\Entities\Owner\OwnerEntity;
use App\Shared\Domain\Repositories\OwnerInGroupRepository;
use App\Shared\Domain\Repositories\OwnerRepository;
use Exception;

final readonly class StoreOwnerUsecase implements StoreOwnerContract
{
    public function __construct(
        private readonly OwnerRepository $ownerRepository,
        private readonly OwnerInGroupRepository $ownerInGroupRepository,
    ) {}

    /**
     * 
     * @param OwnerEntity $data
     * @return void
     */
    public function execute(OwnerEntity $ownerEntity, StoreOwnerOutput $presenter): void
    {
        try {
            $record = $this->ownerRepository->store($ownerEntity);
            $this->ownerInGroupRepository->storeManyGroups(
                $record->id,
                array_map(fn($ownerGroup) => $ownerGroup->id, $ownerEntity->ownerGroups)
            );
            $presenter->onSuccess($record);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
