<?php
declare (strict_types= 1);

namespace App\Features\Owners\Application\Contracts;

use App\Features\Owners\Application\Outputs\DestroyOwnerOutput;

interface DestroyOwnerContract {
    public function destroy(int $id , DestroyOwnerOutput $presenter): void;
}