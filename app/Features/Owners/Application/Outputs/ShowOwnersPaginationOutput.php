<?php
declare (strict_types= 1);

namespace App\Features\Owners\Application\Outputs;

use App\Shared\Domain\Entities\Owner\OwnerEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface  ShowOwnersPaginationOutput {

    /**
     * 
     * @param EntitiesWithPagination<OwnerEntity> $ownerEntitiesWithPagination
     * @return void
     */
    public function onSuccess( EntitiesWithPagination $ownerEntitiesWithPagination):void;

    public function onFailure(string $error):void;
}