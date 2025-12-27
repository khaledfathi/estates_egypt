<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Contracts;

use App\Features\RentInvoices\Application\Outputs\UpdateRentInvoiceOutput;
use App\Shared\Domain\Entities\RentInvoice\RentInvoiceEntity;

interface UpdateRentInvoiceContract{
    public function execute(RentInvoiceEntity $rentInvoiceEntity ,UpdateRentInvoiceOutput $presenter): void;
}

