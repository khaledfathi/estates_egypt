<?php
declare (strict_types=1);
namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\Estate\EstateUtilityServiceEntity;

interface EstateUtilityServiceRepository {
    /**
     * 
     * @return array<EstateUtilityServiceEntity>
     */
    public function indexWhereEstate(int $estateId ):array;
    /**
     * 
     * @param int $estateUtilityServiceId
     * @param bool $estateUtilityServiceOnly query with out estate related data
     * @return void
     */
    public function show(int $estateUtilityServiceId, bool $estateUtilityServiceOnly = false): ?EstateUtilityServiceEntity;
    public function store( EstateUtilityServiceEntity $estateUtilityServiceEntity):EstateUtilityServiceEntity;
    public function update (EstateUtilityServiceEntity $estateUtilityServiceEntity):bool;
    public function destroy (int $estateUtilityServiceId):bool;
}