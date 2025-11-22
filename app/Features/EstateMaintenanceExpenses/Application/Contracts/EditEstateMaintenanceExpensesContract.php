<?php
declare (strict_types=1);
namespace App\Features\EstateMaintenanceExpenses\Application\Contracts;

use App\Features\EstateMaintenanceExpenses\Application\Outputs\EditEstateMaintenanceExpensesOutput;

interface EditEstateMaintenanceExpensesContract {
    public function execute(int $estateMaintenanceExpenseId , EditEstateMaintenanceExpensesOutput $presenter);
}