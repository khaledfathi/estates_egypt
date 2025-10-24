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
    public function show(int $estateUtilityServiceId): ?EstateUtilityServiceEntity;
    public function showWithInvoicesByYear(int $estateUtilityServiceId , int $year): ?EstateUtilityServiceEntity;
    public function store( EstateUtilityServiceEntity $estateUtilityServiceEntity):EstateUtilityServiceEntity;
    public function update (EstateUtilityServiceEntity $estateUtilityServiceEntity):bool;
    public function destroy (int $estateUtilityServiceId):bool;
}