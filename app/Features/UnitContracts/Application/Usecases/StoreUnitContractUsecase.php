<?php
declare (strict_types=1);

namespace App\Features\UnitContracts\Application\Usecases;

use App\Features\UnitContracts\Application\Contracts\StoreUnitContractContract;
use App\Features\UnitContracts\Application\Ouputs\StoreUnitContractOutput;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;
use App\Shared\Domain\Repositories\UnitContractRepository;
use Exception;

final class StoreUnitContractUsecase implements StoreUnitContractContract{

    public function __construct(
        private readonly UnitContractRepository $unitContractRepository,
    ){}
    public function execute(UnitContractEntity $unitContractEntity, StoreUnitContractOutput $presenter):void{
        try {
            $record= $this->unitContractRepository->store($unitContractEntity);
            $presenter->onSuccess($record);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}