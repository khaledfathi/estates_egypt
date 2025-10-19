<?php

declare(strict_types=1);

namespace App\Features\Renters\Application\Contracts;

use App\Features\Renters\Application\Outputs\EditRenterOutput;

interface EditRenterContract
{
    public function execute(int $renterId, EditRenterOutput $presenter): void;
}
