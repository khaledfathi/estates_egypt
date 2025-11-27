<?php
declare(strict_types=1);

namespace App\Features\AccountingManagement\Application\Contracts;

use App\Features\AccountingManagement\Application\Outputs\ShowAllAccountingManagementOutput; 


interface  ShowAllAccountingManagementContract{
    public function execute(ShowAllAccountingManagementOutput $presenter);
}