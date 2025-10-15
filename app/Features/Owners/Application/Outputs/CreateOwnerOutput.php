<?php
declare (strict_types=1);
namespace App\Features\Owners\Application\Outputs;

use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;

interface CreateOwnerOutput {
    /**
     * 
     * @param array<OwnerGroupEntity> $ownerGroups
     * @return void
     */
    public function onSuccess(array $ownerGroups):void;
    public function onFailure(string $error):void;
}