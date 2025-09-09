<?php
declare (strict_types= 1);

namespace App\Features\Owners\Application\Outputs;

use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface  ShowOwnersPaginateOutput {

    public function onSucces( EntitiesWithPagination $ownerEntities):void;
    public function onFailure(string $error):void;
}