<?php
declare(strict_types= 1);

namespace App\Features\Estates\Application\Contracts;

use App\Features\Estates\Application\Outputs\StoreEstateOutput;
use App\Shared\Domain\Entities\Estate\EstateEntity;

interface StoreEstateContract {
    /**
     * 
     * @param EstateEntity $data
     * @return void
     */
    public function store(EstateEntity $estateEntity, StoreEstateOutput $presenter): void;
}