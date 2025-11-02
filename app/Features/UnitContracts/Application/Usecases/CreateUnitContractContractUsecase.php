<?php

declare(strict_types=1);

namespace App\Features\UnitContracts\Application\Usecases;

use App\Features\UnitContracts\Application\Contracts\CreateUnitContractContract;
use App\Features\UnitContracts\Application\Ouputs\CreateUnitContractContractOutput;
use App\Shared\Domain\Repositories\RenterRepositroy;
use App\Shared\Domain\Repositories\UnitRepository;
use Exception;

final class CreateUnitContractContractUsecase implements CreateUnitContractContract
{

    public function __construct(
        private readonly RenterRepositroy $renterRepositroy,
        private readonly UnitRepository $unitRepository,
    ) {}
    public function execute(int $unitId, CreateUnitContractContractOutput $presenter): void
    {
        try {
            $unitEntity = $this->unitRepository->show($unitId);
            if($unitEntity){
                $renters = $this->renterRepositroy->index();
                $presenter->onSuccess($unitEntity , $renters);
            }else {
                $presenter->onUnitNotFound();
            }
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
