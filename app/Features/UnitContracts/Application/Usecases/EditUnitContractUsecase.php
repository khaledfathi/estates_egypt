<?php

declare(strict_types=1);

namespace App\Features\UnitContracts\Application\Usecases;

use App\Features\UnitContracts\Application\Contracts\EditUnitContractContract;
use App\Features\UnitContracts\Application\Ouputs\EditUnitContractOutput;
use App\Shared\Domain\Repositories\RenterRepositroy;
use App\Shared\Domain\Repositories\UnitContractRepository;
use Exception;

final class EditUnitContractUsecase implements EditUnitContractContract
{

    public function __construct(
        private readonly UnitContractRepository $unitContractRepository,
        private readonly RenterRepositroy $renterRepositroy
    ) {}
    public function execute(int $UnitId, EditUnitContractOutput $presenter): void
    {
        $presenter->onNotfound();
        try {
            $unitContractEntity = $this->unitContractRepository->show($UnitId);
            if ($unitContractEntity) {
                $rentersEntitites =  $this->renterRepositroy->index();
                $presenter->onSuccess($unitContractEntity, $rentersEntitites);
            } else {
                $presenter->onNotfound();
            }
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
