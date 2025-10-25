<?php
declare (strict_types=1);
namespace App\Shared\Application\Utility;

use App\Shared\Application\Contracts\Storage\StorageDir;

final class UtilityStorageDir implements StorageDir {

    private string $prefix='';

    public function privatePath():StorageDir{
        $this->prefix = storage_path('app/private/');
        return $this;
    }
    public function publicPath():StorageDir{
        $this->prefix = storage_path('app/public/');
        return $this;
    }
    public function estateDocuments (int $estateId):string{
        return  $this->prefix."estaets/$estateId/documents/";
    }
    public function estateUtilityServicesInvoice(int $estateId , int $utilityServiceId ):string{
        return  $this->prefix."estaets/$estateId/utility_services/$utilityServiceId/invoices/";
    }
}