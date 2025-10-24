<?php
declare (strict_types=1); 
namespace App\Features\EstateUtilityServiceInvoices\Application\Outputs; 

interface DownloadEstateUtilityServiceInvoiceFileOutput 
{
    public function onSuccess(string $filePath):void;
    public function onNotFound():void;
    public function onFailure(string $error):void;
}