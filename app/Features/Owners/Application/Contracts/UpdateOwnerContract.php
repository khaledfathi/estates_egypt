<?php
declare(strict_types= 1);

namespace App\Features\Owners\Application\Contracts;

use App\Features\Owners\Application\Outputs\EditOwnerOutput;
use App\Features\Owners\Application\Outputs\UpdateOwnerOutput;
use App\Shared\Domain\Entities\OwnerEntity;

interface UpdateOwnerContract {
    public function edit(int $id , EditOwnerOutput $presenter): void;
    public function update(OwnerEntity $ownerEntity, UpdateOwnerOutput $presenter): void;
}