<?php
declare (strict_types=1);
namespace App\Features\EstateUtilityServiceInvoices\Application\Contracts;

use App\Features\EstateUtilityServiceInvoices\Application\Outputs\CreateEstateUtilityServiceInvoiceOutput;
use App\Shared\Application\Contracts\Storage\File;

interface  CreateEstateUtilityServiceInvoiceContract {
    public function execute(int $estateUtilityServiceId ,CreateEstateUtilityServiceInvoiceOutput $presenter): void;
}