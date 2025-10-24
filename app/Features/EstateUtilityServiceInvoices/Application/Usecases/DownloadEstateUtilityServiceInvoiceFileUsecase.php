<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServiceInvoices\Application\Usecases;

use App\Features\EstateUtilityServiceInvoices\Application\Contracts\DownloadEstateUtilityServiceInvoiceFileContract;
use App\Features\EstateUtilityServiceInvoices\Application\Outputs\DownloadEstateUtilityServiceInvoiceFileOutput;
use App\Shared\Application\Contracts\Storage\StorageDir;

final class DownloadEstateUtilityServiceInvoiceFileUsecase implements DownloadEstateUtilityServiceInvoiceFileContract
{

    public function __construct(
        private readonly StorageDir $storageDir,
    ) {}
    public function execute(int $estateId, int $estateUtilityServiceId,string $fileName, DownloadEstateUtilityServiceInvoiceFileOutput $presenter): void
    {
        try{
            $file = $this->storageDir->privatePath()->estateUtilityServicesInvoice($estateId, $estateUtilityServiceId ) . $fileName;
            file_exists($file)
                ?  $presenter->onSuccess($file)
                : $presenter->onNotFound();
        }catch(\Exception $e){
            $presenter->onFailure($e->getMessage());
        }
    }
}
