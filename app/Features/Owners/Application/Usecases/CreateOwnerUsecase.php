<?php

declare(strict_types=1);

namespace App\Features\Owners\Application\Usecases;

use App\Features\Owners\Application\Contracts\CreateOwnerContract;
use App\Features\Owners\Application\Outputs\CreateOwnerOutput;
use App\Shared\Domain\Repositories\OwnerGroupRepository;
use Exception;

final class CreateOwnerUsecase implements CreateOwnerContract
{

    public function __construct(
        private readonly OwnerGroupRepository $ownerGroupRepository,
    ) {}
    public function execute(CreateOwnerOutput $presenter): void
    {
        try {
            $presenter->onSuccess($this->ownerGroupRepository->index());
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
