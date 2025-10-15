<?php
declare (strict_types=1);
namespace App\Features\OwnerGroups\Application\Outputs;

use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;

interface  ShowOwnerGroupOutput {
    public function onSuccess(OwnerGroupEntity $ownerGroupEntity):void;
    public function onNotFound():void;
    public function onFailure(string $error):void;

}