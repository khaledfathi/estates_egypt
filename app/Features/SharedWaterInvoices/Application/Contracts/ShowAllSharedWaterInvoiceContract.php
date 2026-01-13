<?php
declare (strict_types=1);
namespace App\Features\SharedWaterInvoices\Application\Contracts;

use App\Features\SharedWaterInvoices\Application\Outputs\ShowAllSharedWaterInvoiceOutput;

interface ShowAllSharedWaterInvoiceContract {
    public function execute (int $contractId ,int $year, ShowAllSharedWaterInvoiceOutput  $presenter):void;
}