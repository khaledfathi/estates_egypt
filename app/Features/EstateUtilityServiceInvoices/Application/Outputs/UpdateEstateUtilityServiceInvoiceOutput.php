<?php
declare (strict_types=1);
namespace App\Features\EstateUtilityServiceInvoices\Application\Outputs;

use App\Features\EstateUtilityServiceInvoices\Application\Outputs\EditEstateUtilityServiceInvoiceOutput;

interface  UpdateEstateUtilityServiceInvoiceOutput{

    public function onSuccess(bool $status ): void;
    public function onFailure($error):void;
}