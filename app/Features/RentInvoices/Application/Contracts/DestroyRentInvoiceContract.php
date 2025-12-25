<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Contracts;

use App\Features\RentInvoices\Application\Outputs\DestroyRentInvoiceOutput;

interface DestroyRentInvoiceContract {
    public function execute(int $rentInvoiceId, DestroyRentInvoiceOutput $presenter): void;
}

