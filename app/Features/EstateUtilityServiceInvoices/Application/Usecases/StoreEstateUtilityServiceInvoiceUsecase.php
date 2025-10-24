<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServiceInvoices\Application\Usecases;

use App\Features\EstateUtilityServiceInvoices\Application\Contracts\StoreEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Application\Outputs\StoreEstateUtilityServiceInvoiceOutput;
use App\Shared\Application\Contracts\Storage\File;
use App\Shared\Application\Contracts\Storage\Storage;
use App\Shared\Application\Contracts\Storage\StorageDir;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceInvoiceEntity;
use App\Shared\Domain\Repositories\EstateUtilityServiceInvoiceRepository;
use Exception;

class StoreEstateUtilityServiceInvoiceUsecase implements StoreEstateUtilityServiceInvoiceContract
{
    public function __construct(
        private readonly EstateUtilityServiceInvoiceRepository $estateUtilityServiceInvoiceRepository,
        private readonly StorageDir $storageDir,
        private readonly Storage $storage,
    ) {}
    public function execute(
        EstateUtilityServiceInvoiceEntity $estateUtilityServiceInvoiceEntity,
        ?File $file,
        StoreEstateUtilityServiceInvoiceOutput $presenter
    ): void {
        $fileName = null;
        $dir = null;
        try {
            //store file 
            if ($file) {
                $dir = $this->storageDir->estateUtilityServicesInvoice(
                    $estateUtilityServiceInvoiceEntity->estate->id,
                    $estateUtilityServiceInvoiceEntity->estateUtilityServiceId
                );
                $fileName = $this->storage->store($dir, $file);
                $estateUtilityServiceInvoiceEntity->file = $fileName;
            }
            //store estate utility service invoice data 
            $record = $this->estateUtilityServiceInvoiceRepository->store($estateUtilityServiceInvoiceEntity);
            $presenter->onSuccess($record);
        } catch (Exception $e) {
            //remove file if upladed 
            if ($dir && $fileName) $file = $this->storage->remove($dir . $fileName);
            // ---
            $presenter->onFailure($e->getMessage());
        }
    }
}
