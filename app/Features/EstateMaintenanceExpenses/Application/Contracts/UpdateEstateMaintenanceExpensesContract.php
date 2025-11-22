<?php
declare (strict_types=1);
namespace App\Features\EstateMaintenanceExpenses\Application\Contracts;

use App\Features\EstateMaintenanceExpenses\Application\Outputs\UpdateEstateMaintenanceExpensesOutput;
use App\Shared\Domain\Entities\Estate\EstateMaintenanceExpensesEntity;

interface UpdateEstateMaintenanceExpensesContract {
    public function execute(EstateMaintenanceExpensesEntity $estateMaintenanceExpensesEntity, UpdateEstateMaintenanceExpensesOutput $presenter):void;
}