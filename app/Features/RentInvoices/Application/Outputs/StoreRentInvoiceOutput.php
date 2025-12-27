<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Outputs;

use App\Shared\Domain\Entities\RentInvoice\RentInvoiceEntity;


interface StoreRentInvoiceOutput{
    public function onSuccess(RentInvoiceEntity $rentInvoiceEntity):void;
    public function onFailure(string $error):void;
}

