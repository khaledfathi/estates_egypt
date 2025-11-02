<?php
declare (strict_types=1);

namespace App\Features\UnitContracts\Application\Usecases;

use App\Features\UnitContracts\Application\Contracts\DestroyUnitContractContract;
use App\Features\UnitContracts\Application\Ouputs\DestroyUnitContractOutput;
use App\Shared\Domain\Repositories\UnitContractRepository;
use Exception;

final class DestroyUnitContractUsecase implements DestroyUnitContractContract{

    public function __construct(
        private readonly UnitContractRepository $unitContractRepository,
    ){}
    public function execute(int $UnitContractId , DestroyUnitContractOutput $presenter):void{
        try {
            $status = $this->unitContractRepository->destroy($UnitContractId);
            $presenter->onSuccess($status);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}