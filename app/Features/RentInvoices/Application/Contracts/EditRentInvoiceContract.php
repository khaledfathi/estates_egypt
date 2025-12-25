<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Contracts;

use App\Features\RentInvoices\Application\Outputs\EditRentInvoiceOutput;

interface EditRentInvoiceContract {
    public function execute(int $rentInvoiceId, EditRentInvoiceOutput $presenter): void;
}

