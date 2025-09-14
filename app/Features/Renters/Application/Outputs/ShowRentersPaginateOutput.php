<?php
declare(strict_types=1);

namespace App\Features\Renters\Application\Outputs;

use App\Shared\Domain\Entities\Renter\RenterEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface   ShowRentersPaginateOutput {

    /**
     * of onSuccess
     * @param EntitiesWithPagination<RenterEntity> $renterEntities
     * @return void
     */
    public function onSuccess (EntitiesWithPagination $renterEntitiesWithPagination):void ;
    public function onFailure (string $error):void ;
}
