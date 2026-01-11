<?php
declare (strict_types=1);
namespace App\Features\SharedWaterInvoices\Application\Contracts;

use App\Features\SharedWaterInvoices\Application\Outputs\UpdateSharedWaterInvoiceOutput;
use App\Shared\Domain\Entities\SharedWaterInvoice\SharedWaterInvoiceEntity;

interface UpdateSharedWaterInvoiceContract {
    public function exectute (SharedWaterInvoiceEntity $sharedWaterInvoiceEntity, UpdateSharedWaterInvoiceOutput $presenter):void;
}
