<?php
declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Application\Usecases;

use App\Features\UnitUtilityServices\Application\Contracts\DestroyUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Application\Outputs\DestroyUnitUtilityServiceOutput;
use App\Shared\Domain\Repositories\UnitUtilityServiceRepository;
use Exception;

final class DestroyUnitUtilityServiceUsecase implements DestroyUnitUtilityServiceContract {

    public function __construct(
        private readonly UnitUtilityServiceRepository $unitUtilityServiceRepository
    ){}
    public function destroy(int $unitUtilityServiceId,  DestroyUnitUtilityServiceOutput $presenter):void
    {
        try{
            $status = $this->unitUtilityServiceRepository->destroy($unitUtilityServiceId);
            $presenter->onSuccess($status);
        }catch(Exception $e){
            $presenter->onFailure($e->getMessage());
        }
    }
}