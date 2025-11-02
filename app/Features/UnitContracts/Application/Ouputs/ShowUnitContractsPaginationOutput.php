<?php
declare (strict_types=1);

namespace App\Features\UnitContracts\Application\Ouputs;

use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface ShowUnitContractsPaginationOutput {
    public function onSuccess(UnitEntity $unitEntity , EntitiesWithPagination $UnitContractEntitiesWithPagination):void;
    public function onUnitNotFound():void;
    public function onFailure(string $error):void;
}