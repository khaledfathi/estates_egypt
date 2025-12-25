<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Outputs; 


interface DestroyRentInvoiceOutput {
    public function onSeuccess(bool $status):void; 
    public function onFailure(string $error):void; 
}

