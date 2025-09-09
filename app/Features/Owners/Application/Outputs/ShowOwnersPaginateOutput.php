<?php
declare (strict_types= 1);

namespace App\Features\Owners\Application\Outputs;

use App\Features\Owners\Application\DTOs\OwnerEntitiesWithPagination;

interface  ShowOwnersPaginateOutput {

    public function onSucces( OwnerEntitiesWithPagination $ownerEntities):void;
    public function onFailure(string $error):void;
}