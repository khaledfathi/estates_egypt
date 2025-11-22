<?php
declare (strict_types=1);
namespace  App\Features\EstateMaintenanceExpenses\Application\Contracts;

use App\Features\EstateMaintenanceExpenses\Application\Outputs\ShowEstateMaintenanceExpensesOutput;

interface ShowEstateMaintenanceExpensesContract {
    public function execute(int $estateMaintenanceExpenseId , ShowEstateMaintenanceExpensesOutput $presenter);
}