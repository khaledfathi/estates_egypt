<?php
declare (strict_types=1);

namespace App\Features\OwnerGroups\Application\Contracts;

use App\Features\OwnerGroups\Application\Outputs\StoreOwnerGroupOutput;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;

interface StoreOwnerGroupContract { 
    public function store (OwnerGroupEntity $ownerGroupEntity ,  StoreOwnerGroupOutput $presenter):void;
}