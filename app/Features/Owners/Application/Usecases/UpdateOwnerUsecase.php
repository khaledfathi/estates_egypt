<?php
declare(strict_types=1);

namespace App\Features\Owners\Application\Usecases;

use App\Features\Owners\Application\Contracts\UpdateOwnerContract;
use App\Features\Owners\Application\Outputs\EditOwnerOutput;
use App\Features\Owners\Application\Outputs\UpdateOwnerOutput;
use App\Shared\Domain\Entities\Owner\OwnerEntity;
use App\Shared\Domain\Repositories\OwnerRepository;

final class UpdateOwnerUsecase implements UpdateOwnerContract
{
    public function __construct(
        private readonly OwnerRepository $ownerRepository
    ) {}
    public function edit(int $ownerId, EditOwnerOutput $presenter): void
    {
        try {
            $record = $this->ownerRepository->show($ownerId);
            $record
                ? $presenter->onSuccess($record)
                : $presenter->onNotFound();
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
    public function update(OwnerEntity $ownerEntity, UpdateOwnerOutput $presenter): void
    {
        try {
            $presenter->onSuccess($this->ownerRepository->update($ownerEntity));
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }

}
