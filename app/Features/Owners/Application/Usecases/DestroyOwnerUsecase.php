<?php
declare(strict_types=1);

namespace App\Features\Owners\Application\Usecases;

use App\Features\Owners\Application\Contracts\DestroyOwnerContract;
use App\Features\Owners\Application\Outputs\DestroyOwnerOutput;
use App\Shared\Domain\Repositories\OwnerRepository;

final class DestroyOwnerUsecase implements DestroyOwnerContract
{
    public function __construct(
        private readonly OwnerRepository $ownerRepository
    ) {}
    public function destroy(int $id, DestroyOwnerOutput $presenter): void
    {
        try {
            $presenter->onSuccess($this->ownerRepository->destroy($id));
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
