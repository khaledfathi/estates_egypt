<?php
declare (strict_types=1);
namespace App\Features\EstateUtilityServiceInvoices\Application\Contracts;

use App\Features\EstateUtilityServiceInvoices\Application\Outputs\DestroyEstateUtilityServiceInvoiceOutput;

interface  DestroyEstateUtilityServiceInvoiceContract {
    public function execute(int $estateUtilityServiceInvoiceId ,DestroyEstateUtilityServiceInvoiceOutput $presenter): void;
}