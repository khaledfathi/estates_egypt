<?php
declare(strict_types=1);

namespace App\Features\Owners\Application\Usecases;

use App\Features\Owners\Application\Contracts\ShowOwnerContract;
use App\Features\Owners\Application\Outputs\ShowOwnerOutput;
use App\Features\Owners\Application\Outputs\ShowOwnersPaginateOutput;
use App\Shared\Domain\Repositories\OwnerRepository;

final  class ShowOwnerUsecase implements ShowOwnerContract{

    public function __construct(
        private readonly OwnerRepository $ownerRepository
    ){ }

    public function allWithPaginate(ShowOwnersPaginateOutput $presenter , int $perPage=5):void
    {
        try {
            $presenter->onSuccess($this->ownerRepository->indexWithPaginate($perPage));

        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
    public function showById (int $ownerId , ShowOwnerOutput $presenter):void
    {
        try {
            $record = $this->ownerRepository->show($ownerId);
            $record 
                ? $presenter->onSuccess($record)
                : $presenter->onNotFound();

        }catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }

    }

}