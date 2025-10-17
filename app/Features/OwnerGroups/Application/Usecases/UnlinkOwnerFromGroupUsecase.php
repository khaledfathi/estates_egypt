<?php
declare(strict_types=1);
namespace App\Features\OwnerGroups\Application\Usecases;

use App\Features\OwnerGroups\Application\Contracts\UnlinkOwnerFromGroupContract;
use App\Features\OwnerGroups\Application\Outputs\UnlinkOwnerFromGroupOutput;
use App\Shared\Domain\Repositories\OwnerInGroupRepository;
use Exception;

final class  UnlinkOwnerFromGroupUsecase implements UnlinkOwnerFromGroupContract {

    public function __construct(
        private readonly OwnerInGroupRepository $ownerInGroupRepository
    ){}
    public function execute(int $ownerInGroupId , UnlinkOwnerFromGroupOutput $presenter){
        try {
            $status =  $this->ownerInGroupRepository->destroy($ownerInGroupId);
            $presenter->onSuccess($status);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}