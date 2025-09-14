<?php
declare (strict_types= 1);

namespace App\Features\Owners\Application\Outputs;

use App\Shared\Domain\Entities\Owner\OwnerEntity;

interface StoreOwnerOutput {
    public function onSuccess (OwnerEntity $ownerEntity):void ;
    public function onFailure (string $error):void ;
}