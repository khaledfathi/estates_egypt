<?php
declare (strict_types=1);
namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\Unit\UnitUtilityServiceEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface UnitUtilityServiceRepository {
    /**
     * 
     * @return array<UnitUtilityServiceEntity> 
     */
    public function index (int $unitId):array;

    public function store(UnitUtilityServiceEntity $unitUtilityServiceEntity): UnitUtilityServiceEntity;

    /**
     * 
     * @param int $unitUtilityServiceId
     * @param bool $UnitUtilityServiceOnly retrive UnitEntity with result
     * @return void
     */
    public function show(int $unitUtilityServiceId ): UnitUtilityServiceEntity|null;
    public function update (UnitUtilityServiceEntity $unitUtilityServiceEntity):bool;
    public function destroy (int $unitUtilityServiceId):bool; 
}