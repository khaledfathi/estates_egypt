<?php
declare (strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Application\Contracts;

use App\Features\EstateMaintenanceExpenses\Application\Outputs\StoreEstateMaintenanceExpensesOutput;
use App\Shared\Domain\Entities\Estate\EstateMaintenanceExpensesEntity;

interface StoreEstateMaintenanceExpensesContract{
    public function execute(EstateMaintenanceExpensesEntity $estateMaintenanceExpensesEntity, StoreEstateMaintenanceExpensesOutput $presenter ):void;
}