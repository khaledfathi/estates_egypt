<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Contracts;

use App\Features\RentInvoices\Application\Outputs\CreateRentInvoiceOutput;

interface CreateRentInvoiceContract {
    public function execute(int $unitContractId ,  CreateRentInvoiceOutput $presenter): void;
}

