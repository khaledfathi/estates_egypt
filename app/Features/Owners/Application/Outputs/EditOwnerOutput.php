<?php
declare (strict_types= 1);

namespace App\Features\Owners\Application\Outputs;

use App\Shared\Domain\Entities\OwnerEntity;

interface EditOwnerOutput {
    public function onSuccess (OwnerEntity $ownerEntity):void;
    public function onFailure (string $error):void;
    public function onNotFound():void;
}