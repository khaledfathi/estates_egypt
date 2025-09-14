<?php
declare(strict_types= 1);

namespace App\Features\Renters\Application\Contracts;

use App\Features\Renters\Application\Outputs\EditRenterOutput;
use App\Features\Renters\Application\Outputs\UpdateRenterOutput;
use App\Shared\Domain\Entities\Renter\RenterEntity;

interface UpdateRenterContract {
    public function edit(int $renterId, EditRenterOutput $presenter): void;
    public function update(RenterEntity  $renterEntity, UpdateRenterOutput $presenter): void;
}