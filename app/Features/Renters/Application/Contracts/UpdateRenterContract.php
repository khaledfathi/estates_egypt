<?php
declare(strict_types= 1);

namespace App\Features\Renters\Application\Contracts;

use App\Features\Renters\Application\Outputs\UpdateRenterOutput;
use App\Shared\Domain\Entities\Renter\RenterEntity;

interface UpdateRenterContract {
    public function execute(RenterEntity  $renterEntity, UpdateRenterOutput $presenter): void;
}