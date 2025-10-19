<?php
declare (strict_types=1);
namespace App\Features\OwnerGroups\Application\Usecases;

use App\Features\OwnerGroups\Application\Contracts\StoreOwnerGroupContract;
use App\Features\OwnerGroups\Application\Outputs\StoreOwnerGroupOutput;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Domain\Repositories\OwnerGroupRepository;
use Exception;

final class StoreOwnerGroupUsecase implements StoreOwnerGroupContract{
    public function __construct(
        private readonly OwnerGroupRepository $ownerGroupRepository,
    ){}
    public function execute (OwnerGroupEntity $ownerGroupEntity ,  StoreOwnerGroupOutput $presenter):void{
        try {
            $record = $this->ownerGroupRepository->store($ownerGroupEntity);
            $presenter->onSuccess($record);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}