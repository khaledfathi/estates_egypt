<?php

declare(strict_types=1);

namespace App\Features\Owners\Application\Usecases;

use App\Features\Owners\Application\Contracts\StoreOwnerContract;
use App\Features\Owners\Application\Outputs\CreateOwnerOutput;
use App\Features\Owners\Application\Outputs\StoreOwnerOutput;
use App\Shared\Domain\Entities\Owner\OwnerEntity;
use App\Shared\Domain\Repositories\OwnerGroupRepository;
use App\Shared\Domain\Repositories\OwnerInGroupRepository;
use App\Shared\Domain\Repositories\OwnerRepository;
use Exception;

final readonly class StoreOwnerUsecase implements StoreOwnerContract
{
    public function __construct(
        private readonly OwnerRepository $ownerRepository,
        private readonly OwnerGroupRepository $ownerGroupRepository,
        private readonly OwnerInGroupRepository $ownerInGroupRepository,
    ) {}

    public function create(CreateOwnerOutput $presenter): void
    {
        try {
            $presenter->onSuccess($this->ownerGroupRepository->index());
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
    /**
     * 
     * @param OwnerEntity $data
     * @return void
     */
    public function store(OwnerEntity $ownerEntity, StoreOwnerOutput $presenter): void
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
