<?php
declare (strict_types=1);
namespace  App\Features\EstateMaintenanceExpenses\Application\Contracts;

use App\Features\EstateMaintenanceExpenses\Application\Outputs\DestroyEstateMaintenanceExpensesOutput;

interface DestroyEstateMaintenanceExpensesContract {
    public function execute(int $estateMaintenanceExpensesId, DestroyEstateMaintenanceExpensesOutput $presenter);
}