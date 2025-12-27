<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Contracts;

use App\Features\RentInvoices\Application\Outputs\StoreRentInvoiceOutput;
use App\Shared\Domain\Entities\RentInvoice\RentInvoiceEntity;

interface StoreRentInvoiceContract{
    public function execute( RentInvoiceEntity $rentInvoiceEntity , StoreRentInvoiceOutput $presenter): void;
}

