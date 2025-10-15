<?php
declare(strict_types=1);

namespace App\Features\Owners\Application\Usecases;

use App\Features\Owners\Application\Contracts\StoreOwnerContract;
use App\Features\Owners\Application\Outputs\CreateOwnerOutput;
use App\Features\Owners\Application\Outputs\StoreOwnerOutput;
use App\Shared\Domain\Entities\Owner\OwnerEntity;
use App\Shared\Domain\Repositories\OwnerGroupRepository;
use App\Shared\Domain\Repositories\OwnerRepository;
use Exception;

final readonly class StoreOwnerUsecase implements StoreOwnerContract 
{
    public function __construct(
        private readonly OwnerRepository $ownerRepository,
        private readonly OwnerGroupRepository $ownerGroupRepository,
    ) {}

    public function create (CreateOwnerOutput $presenter): void{
        try{
            $presenter->onSuccess( $this->ownerGroupRepository->index());
        }catch(Exception $e) {
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
            $presenter->onSuccess( $this->ownerRepository->store($ownerEntity));
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
