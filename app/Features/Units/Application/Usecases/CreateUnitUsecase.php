<?php
declare (strict_types=1);
namespace App\Features\Units\Application\Usecases;

use App\Features\Units\Application\Contracts\CreateUnitContract;
use App\Features\Units\Application\DTOs\UnitFormDTO;
use App\Features\Units\Application\Ouputs\CreateUnitOutput;
use App\Shared\Domain\Enum\Unit\UnitIsEmpty;
use App\Shared\Domain\Enum\Unit\UnitType;
use App\Shared\Domain\Repositories\EstateRepositroy;
use Exception;

final class CreateUnitUsecase implements CreateUnitContract {

    public function __construct(
        private readonly EstateRepositroy $estateRepositroy,
    ) {}
    public function execute(int $estateId, CreateUnitOutput $presenter):void {
        try {
            $estate = $this->estateRepositroy->show($estateId);
            $unitTypes = UnitType::labels();
            $unitIsEmptyLabels = UnitIsEmpty::labels();
            $unitFormDTO = new UnitFormDTO(
                $estate,
                $unitTypes,
                $unitIsEmptyLabels
            );
            $presenter->onSuccess($unitFormDTO);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }

    }
}