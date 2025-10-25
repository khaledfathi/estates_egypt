<?php
declare (strict_types=1); 
namespace App\Features\EstateUtilityServiceInvoices\Application\Contracts;

use App\Features\EstateUtilityServiceInvoices\Application\Outputs\DownloadEstateUtilityServiceInvoiceFileOutput;

interface DownloadEstateUtilityServiceInvoiceFileContract 
{
    public function execute(int $estateId, int $estateUtilityServiceId,string $fileName, DownloadEstateUtilityServiceInvoiceFileOutput $presenter): void;
}