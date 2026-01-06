<?php
declare (strict_types=1);
namespace App\Features\SharedWaterInvoices\Application\Contracts;

use App\Features\SharedWaterInvoices\Application\Outputs\EditSharedWaterInvoiceOutput;

interface EditSharedWaterInvoiceContract {
    public function exectute (int $sharedWaterInvoiceId , EditSharedWaterInvoiceOutput $presenter):void;
}
