<?php
declare(strict_types=1);

namespace App\Features\UnitOwnerships\Application\Usecases;

use App\Features\UnitOwnerships\Application\Contracts\DestroyUnitOwnershipContract;
use App\Features\UnitOwnerships\Application\Outputs\DestroyUnitOwnershipOutput;
use App\Shared\Domain\Repositories\UnitOwnershipRepository;
use Exception;

final class DestroyUnitOwnershipUsecase implements DestroyUnitOwnershipContract {
    public function __construct(
        private readonly UnitOwnershipRepository $unitOwnershipRepository,
    ){}
    public function destroy(int $unitOwnershipId , DestroyUnitOwnershipOutput $presenter):void{
        try{
            $status = $this->unitOwnershipRepository->destroy($unitOwnershipId);
            $presenter->onSuccess($status);
        }catch(Exception $e){
            $presenter->onFailure($e->getMessage());
        }
    }
}