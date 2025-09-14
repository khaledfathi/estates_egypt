<?php
declare(strict_types= 1);

namespace App\Features\Owners\Application\Contracts;

use App\Features\Owners\Application\Outputs\StoreOwnerOutput;
use App\Shared\Domain\Entities\Owner\OwnerEntity;

interface StoreOwnerContract {
    /**
     * 
     * @param OwnerEntity $data
     * @return void
     */
    public function create(OwnerEntity $ownerEntity, StoreOwnerOutput $presenter): void;
}