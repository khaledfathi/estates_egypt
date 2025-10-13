<?php
declare(strict_types=1);
namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\Unit\UnitOwnershipEntity;

interface UnitOwnershipRepository {
    public function store(UnitOwnershipEntity $unitOwnershipEntity):UnitOwnershipEntity;
    public function destroy (int $unitOwnershipId):bool;
}