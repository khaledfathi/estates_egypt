<?php

declare(strict_types=1);

namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\Estate\EstateMaintenanceExpensesEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface EstateMaintenanceExpensesRepository
{
    /**
     * @return array<EstateMaintenanceExpensesEntity> 
     */
    public function index(): array;
    /**
     * @param int $perPage
     * @return EntitiesWithPagination<EstateMaintenanceExpensesEntity> 
     */
    public function indexWithPaginateByEstateIdAndYear(int $estateId ,int $year, int $perPage): EntitiesWithPagination;
    public function store(EstateMaintenanceExpensesEntity $estateMaintenanceExpensesEntity): EstateMaintenanceExpensesEntity;
    public function show(int $estateMaintenanceExpensesId): EstateMaintenanceExpensesEntity|null;
    public function update(EstateMaintenanceExpensesEntity $estateMaintenanceExpensesEntity): bool;
    public function destroy(int $estateMaintenanceExpensesId): bool;
}
