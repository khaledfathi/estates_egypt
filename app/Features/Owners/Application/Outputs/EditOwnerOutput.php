<?php
declare (strict_types= 1);

namespace App\Features\Owners\Application\Outputs;

use App\Shared\Domain\Entities\Owner\OwnerEntity;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;

interface EditOwnerOutput {
    /**
     * 
     * @param OwnerEntity $ownerEntity
     * @param array<OwnerGroupEntity> $ownerGroupEnitites
     * @return void
     */
    public function onSuccess (OwnerEntity $ownerEntity , array $ownerGroupEnitites):void;
    public function onFailure (string $error):void;
    public function onNotFound():void;
}