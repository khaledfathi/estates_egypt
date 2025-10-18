<?php
declare (strict_types= 1);
namespace App\Features\Units\Application\Ouputs;

use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface ShowUnitsPaginationOutput {
    /**
     * of onSuccess
     * @param EntitiesWithPagination<UnitEntity> $unitEntitiesWithPagination
     * @return void
     */
    public function onSuccess (EntitiesWithPagination $unitEntitiesWithPagination , EstateEntity $estateEntity):void ;
    public function onFailure (string $error):void ;
    public function onEstateNotFound ():void ;
}