<?php
declare(strict_types= 1);

namespace App\Features\Renters\Application\Outputs;

use App\Shared\Domain\Entities\Renter\RenterEntity;

interface ShowRenterOutput {
    public function onSuccess(RenterEntity $renterEntity):void;
    public function onNotFount():void;
    public function onFailure(String $error):void;
}