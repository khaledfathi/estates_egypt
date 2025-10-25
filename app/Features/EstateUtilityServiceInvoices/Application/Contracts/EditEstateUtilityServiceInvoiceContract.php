<?php
declare (strict_types=1);
namespace App\Features\EstateUtilityServiceInvoices\Application\Contracts;

use App\Features\EstateUtilityServiceInvoices\Application\Outputs\EditEstateUtilityServiceInvoiceOutput;

interface  EditEstateUtilityServiceInvoiceContract {
    public function execute(int $estateUtilityServiceId , EditEstateUtilityServiceInvoiceOutput $presenter): void;
}