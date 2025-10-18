<?php
declare (strict_types=1);
namespace App\Features\Owners\Application\Contracts;

use App\Features\Owners\Application\Outputs\EditOwnerOutput;

interface EditOwnerContract {
    public function execute(int $ownerId , EditOwnerOutput $presenter): void;
}