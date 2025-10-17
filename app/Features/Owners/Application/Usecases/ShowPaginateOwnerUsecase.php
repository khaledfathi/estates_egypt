<?php
declare (strict_types=1);
namespace App\Features\Owners\Application\Usecases;

use App\Features\Owners\Application\Contracts\ShowPaginateOwnerContract;
use App\Features\Owners\Application\Outputs\ShowOwnersPaginateOutput;
use App\Shared\Domain\Repositories\OwnerRepository;

final class ShowPaginateOwnerUsecase implements ShowPaginateOwnerContract {
    public function __construct(
        private readonly OwnerRepository $ownerRepository
    ){ }
    public function execute(ShowOwnersPaginateOutput $presenter, int $perPage = 5): void{
        try {
            $presenter->onSuccess($this->ownerRepository->indexWithPaginate($perPage));

        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}