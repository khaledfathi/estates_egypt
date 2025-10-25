<?php

declare(strict_types=1);

namespace App\Features\Owners\Application\Contracts;

use App\Features\Owners\Application\Outputs\UpdateOwnerOutput;
use App\Shared\Domain\Entities\Owner\OwnerEntity;

interface UpdateOwnerContract
{
    public function execute(OwnerEntity $ownerEntity, UpdateOwnerOutput $presenter): void;
}
