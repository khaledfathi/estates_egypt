<?php
declare (strict_types=1);

namespace App\Features\UnitContracts\Application\Usecases;

use App\Features\UnitContracts\Application\Contracts\UpdateUnitContractContract;
use App\Features\UnitContracts\Application\Ouputs\UpdateUnitContractOutput;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;
use App\Shared\Domain\Repositories\UnitContractRepository;
use Exception;

final class UpdateUnitContractUsecase implements UpdateUnitContractContract{
    public function __construct(
        private readonly UnitContractRepository $unitContractRepository
    ){}
    public function execute(UnitContractEntity $unitContractEntity, UpdateUnitContractOutput $presenter):void{
        try {
            $status = $this->unitContractRepository->update($unitContractEntity);
            $presenter->onSuccess($status);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}