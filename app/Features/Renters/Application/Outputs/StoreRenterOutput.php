<?php
declare(strict_types= 1);
namespace App\Features\Renters\Application\Outputs;

use App\Shared\Domain\Entities\Renter\RenterEntity;

interface StoreRenterOutput {
    
    public function onSuccess (RenterEntity $renterEntity):void ;
    public function onFailure (string $error):void ;
}