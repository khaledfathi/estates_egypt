<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Contracts;

use App\Features\RentInvoices\Application\Outputs\ShowAllRentInvoicesOutput;

interface ShowAllRentInvoicesContract {
    public function execute(int $contractId , int $year ,ShowAllRentInvoicesOutput $presenter): void;
}

