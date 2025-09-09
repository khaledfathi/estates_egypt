<?php
declare(strict_types= 1);

namespace App\Features\Owners\Application\Outputs;

use App\Shared\Domain\Entities\OwnerEntity;

interface  ShowOwnerOutput{
    public function onSuccess(OwnerEntity $ownerEntity):void;
    public function onNotFount():void;
    public function onFailure(String $error):void;
}