<?php
declare(strict_types= 1);

namespace App\Features\Owners\Application\Contracts;

use App\Features\Owners\Application\Outputs\CreateOwnerOutput;
use App\Features\Owners\Application\Outputs\StoreOwnerOutput;
use App\Shared\Domain\Entities\Owner\OwnerEntity;

interface StoreOwnerContract {
    public function create (CreateOwnerOutput $presenter): void;
    /**
     * 
     * @param OwnerEntity $data
     * @return void
     */
    public function store (OwnerEntity $ownerEntity, StoreOwnerOutput $presenter): void;
}