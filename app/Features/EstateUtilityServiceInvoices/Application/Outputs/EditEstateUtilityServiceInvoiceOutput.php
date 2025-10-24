<?php
declare (strict_types=1);
namespace App\Features\EstateUtilityServiceInvoices\Application\Outputs;

use App\Shared\Domain\Entities\Estate\EstateUtilityServiceInvoiceEntity; 


interface  EditEstateUtilityServiceInvoiceOutput{
    public function onSuccess(EstateUtilityServiceInvoiceEntity $estateUtilityServiceInvoiceEntity):void;
    public function onNotFound():void;
    public function onFailure(string $error):void;
}