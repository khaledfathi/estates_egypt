<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Contracts;

use App\Features\RentInvoices\Application\Outputs\ShowRentInvoiceOutput;

interface ShowRentInvoiceContract {
    public function execute(int $rentInvoiceId, ShowRentInvoiceOutput $presenter): void;
}

