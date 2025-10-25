<?php
declare(strict_types=1);

namespace App\Features\Renters\Application\Outputs;

use App\Shared\Domain\Entities\Renter\RenterEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface   ShowRentersPaginationOutput {

    /**
     * of onSuccess
     * @param EntitiesWithPagination<RenterEntity> $renterEntitiesWithPagination
     * @return void
     */
    public function onSuccess (EntitiesWithPagination $renterEntitiesWithPagination):void ;
    public function onFailure (string $error):void ;
}
