<?php
declare (strict_types=1);

namespace App\Features\UnitContracts\Application\Usecases; 

use App\Features\UnitContracts\Application\Contracts\ShowUnitContractContract;
use App\Features\UnitContracts\Application\Ouputs\ShowUnitContractOutput;
use App\Shared\Domain\Repositories\UnitContractRepository;
use Exception;

final class ShowUnitContractUsecase implements ShowUnitContractContract{
    public function __construct(
        private readonly UnitContractRepository $unitContractRepository
    ){} 
    public function execute(int $UnitContractId , ShowUnitContractOutput $presenter):void{
        try {
            $record = $this->unitContractRepository->show($UnitContractId);
            $record 
                ? $presenter->onSuccess($record)
                : $presenter->onNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}