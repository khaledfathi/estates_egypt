<?php
declare(strict_types=1);

namespace App\Features\MaintenanceExpenses\Application\Contracts;

use App\Features\MaintenanceExpenses\Application\Outputs\ShowAllMaintenanceExpensesOutput;

interface ShowAllMaintenanceExpensesContract{
    public function execute(ShowAllMaintenanceExpensesOutput $presenter);
}