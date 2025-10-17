<?php

declare(strict_types=1);

namespace App\Features\OwnerGroups\Application\Usecases;

use App\Features\OwnerGroups\Application\Contracts\ShowOwnerGroupContract;
use App\Features\OwnerGroups\Application\Outputs\ShowOwnerGroupOutput;
use App\Shared\Domain\Repositories\OwnerGroupRepository;
use Exception;

final class ShowOwnerGroupUsecase implements ShowOwnerGroupContract 
{

    public function __construct(
        private readonly OwnerGroupRepository $ownerGroupRepository
    ) {}
    public function execute (int $ownerGroupId , ShowOwnerGroupOutput $presneter){
        try{
            $record = $this->ownerGroupRepository->show($ownerGroupId);
            $record
                ? $presneter->onSuccess($record)
                : $presneter->onNotFound();
        }catch(Exception $e){
            $presneter->onFailure($e->getMessage());
        }
    }
}
