<?php
declare (strict_types= 1);

namespace App\Features\Renters\Application\Contracts;

use App\Features\Renters\Application\Outputs\StoreRenterOutput;
use App\Shared\Domain\Entities\Renter\RenterEntity;

interface StoreRenterContract { 

    /**
     * 
     * @param RenterEntity $renterEntity
     * @param StoreRenterOutput $presenter
     * @return void
     */
    public function execute(RenterEntity $renterEntity, StoreRenterOutput $presenter): void;
}