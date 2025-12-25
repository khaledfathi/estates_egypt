<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Outputs; 


interface UpdateRentInvoiceOutput{
    public function onSuccess (bool $status ):void;
    public function onFailure(string $error):void;
}

