<?php
declare (strict_types=1);
namespace App\Features\Owners\Application\Usecases;

use App\Features\Owners\Application\Contracts\ShowOwnersPaginationContract;
use App\Features\Owners\Application\Outputs\ShowOwnersPaginationOutput;
use App\Shared\Domain\Repositories\OwnerRepository;

final class ShowPaginateOwnerUsecase implements ShowOwnersPaginationContract {
    public function __construct(
        private readonly OwnerRepository $ownerRepository
    ){ }
    public function execute(ShowOwnersPaginationOutput $presenter, int $perPage = 5): void{
        try {
            $presenter->onSuccess($this->ownerRepository->indexWithPaginate($perPage));

        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}