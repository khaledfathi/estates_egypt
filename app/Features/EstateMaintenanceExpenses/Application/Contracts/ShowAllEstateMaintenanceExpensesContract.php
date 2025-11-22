<?php
declare (strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Application\Contracts;

use App\Features\EstateMaintenanceExpenses\Application\Outputs\ShowAllEstateMaintenanceExpensesOutput;

interface ShowAllEstateMaintenanceExpensesContract {
    public function execute(int $estateId , ShowAllEstateMaintenanceExpensesOutput $presenter , int $perPage=10):void;
}