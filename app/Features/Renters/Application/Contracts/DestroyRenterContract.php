<?php
declare(strict_types= 1);

namespace App\Features\Renters\Application\Contracts;

use App\Features\Renters\Application\Outputs\DestroyRenterOutput;

interface DestroyRenterContract {
    public function destroy(int $renterId , DestroyRenterOutput  $presenter): void;
}