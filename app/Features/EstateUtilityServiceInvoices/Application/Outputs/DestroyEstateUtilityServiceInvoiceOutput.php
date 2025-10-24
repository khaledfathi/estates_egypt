<?php
declare (strict_types=1);
namespace App\Features\EstateUtilityServiceInvoices\Application\Outputs; 


interface DestroyEstateUtilityServiceInvoiceOutput {
    public function onSuccess(bool $status ): void;
    public function onFailure($error):void;
}