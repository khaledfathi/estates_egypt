<?php

declare(strict_types=1);

namespace App\Features\Owners\Application\Usecases;

use App\Features\Owners\Application\Contracts\EditOwnerContract;
use App\Features\Owners\Application\Outputs\EditOwnerOutput;
use App\Shared\Domain\Repositories\OwnerGroupRepository;
use App\Shared\Domain\Repositories\OwnerRepository;
use Exception;

final class EditOwnerUsecase implements EditOwnerContract
{
    public function __construct(
        private readonly OwnerRepository $ownerRepository,
        private readonly OwnerGroupRepository $ownerGroupRepository,
    ) {}
    public function execute(int $ownerId, EditOwnerOutput $presenter): void
    {
        try {
            $record = $this->ownerRepository->show($ownerId);
            if ($record) {
                $ownerGroupEnitites = $this->ownerGroupRepository->index();
                $presenter->onSuccess($record, $ownerGroupEnitites);
            } else {
                $presenter->onNotFound();
            }
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
