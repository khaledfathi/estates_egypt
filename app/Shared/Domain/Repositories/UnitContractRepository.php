<?php
declare (strict_types=1);
namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\Unit\UnitContractEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface UnitContractRepository {
    /**
     * @param int $unitId
     * @param int $perPage
     * @return EntitiesWithPagination<UnitContractEntity>
     */
    public function indexWithPaginateByUnitId(int $unitId, int $perPage): EntitiesWithPagination;
    public function store (UnitContractEntity $UnitContractEntity):UnitContractEntity;
    public function show (int $UnitContractId):UnitContractEntity|null;
    public function update (UnitContractEntity $unitContractEntity):bool;
    public function destroy (int $UnitContractEntity):bool; 
}