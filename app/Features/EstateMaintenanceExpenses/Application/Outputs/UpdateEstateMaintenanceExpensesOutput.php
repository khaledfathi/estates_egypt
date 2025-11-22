<?php
declare (strict_types=1);
namespace App\Features\EstateMaintenanceExpenses\Application\Outputs; 


interface UpdateEstateMaintenanceExpensesOutput {
    public function onSuccess(bool $status):void;
    public function onFailure(string $error):void;
}