<?php
declare (strict_types=1);
namespace App\Features\OwnerGroups\Application\Usecases;

use App\Features\OwnerGroups\Application\Contracts\ShowPaginateOwnerGroupContract;
use App\Features\OwnerGroups\Application\Outputs\ShowOwnerGroupsPaginateOutput;
use App\Shared\Domain\Repositories\OwnerGroupRepository;
use Exception;

final class ShowPaginateOwnerGroupUsecase implements  ShowPaginateOwnerGroupContract {
    public function __construct(
        private readonly OwnerGroupRepository $ownerGroupRepository
    ) {}
    public function execute (ShowOwnerGroupsPaginateOutput $presenter, int $perPage = 5){
        try {
            $presenter->onSuccess($this->ownerGroupRepository->indexWithPaginate($perPage));
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }

    }
}
