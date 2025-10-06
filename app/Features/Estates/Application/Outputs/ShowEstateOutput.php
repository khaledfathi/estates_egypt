<?php
declare(strict_types= 1);
namespace App\Features\Estates\Application\Outputs;

use App\Shared\Domain\Entities\Estate\EstateEntity;

interface ShowEstateOutput {

    public function onSuccess (EstateEntity $estateEntity):void ;
    public function onNotFound():void;
    public function onFailure (string $error):void ;
}