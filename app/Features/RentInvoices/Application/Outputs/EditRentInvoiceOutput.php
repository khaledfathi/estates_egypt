<?php

declare(strict_types=1);

namespace App\Features\RentInvoices\Application\Outputs;

use App\Shared\Domain\Entities\RentsPayment\RentInvoiceEntity;

interface EditRentInvoiceOutput
{
    public function onSuccess(RentInvoiceEntity $rentInvoiceEntity):void;
    public function onNotFound():void;
    public function onFailure(string $error):void;
}
