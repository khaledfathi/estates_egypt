<?php
declare (strict_types=1);
namespace App\Features\SharedWaterInvoices\Application\Outputs;

use App\Shared\Domain\Entities\SharedWaterInvoice\SharedWaterInvoiceEntity;

interface EditSharedWaterInvoiceOutput {
    public function onSuccess ( SharedWaterInvoiceEntity $sharedWaterInvoiceEntity):void;
    public function onNotFound ():void;
    public function onFailure ( string $error ):void;
}
