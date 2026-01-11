<?php
declare (strict_types=1);
namespace App\Features\SharedWaterInvoices\Application\Outputs; 


interface UpdateSharedWaterInvoiceOutput {
    public function onSuccess (bool $status):void ;
    public function onFailure (string $error):void ;
}
