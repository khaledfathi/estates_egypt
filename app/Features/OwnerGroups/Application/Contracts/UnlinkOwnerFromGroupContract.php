<?php
declare (strict_types=1);

namespace App\Features\OwnerGroups\Application\Contracts;

use App\Features\OwnerGroups\Application\Outputs\UnlinkOwnerFromGroupOutput;

interface UnlinkOwnerFromGroupContract {
    public function unlink(int $ownerInGroupId , UnlinkOwnerFromGroupOutput $presenter);
}