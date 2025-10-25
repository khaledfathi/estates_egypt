<?php
declare (strict_types=1);
namespace App\Features\OwnerGroups\Application\Outputs;

use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;

interface StoreOwnerGroupOutput {
    public function onSuccess(OwnerGroupEntity $ownerGroupEntity):void;
    public function onFailure($error):void;
}