<?php
declare(strict_types=1);
namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\Unit\UnitOwnershipEntity;

interface UnitOwnershipRepository {
    public function store(UnitOwnershipEntity $unitOwnershipEntity):UnitOwnershipEntity;

    /**
     * @param int $unitId
     * @param array<int> $ownersIds 
     * @return array<UnitOwnershipEntity>
     */
    public function storeManyOwners(int $unitId , array $ownersIds): array;
    public function destroy (int $unitOwnershipId):bool;
}