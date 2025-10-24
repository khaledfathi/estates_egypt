<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServiceInvoices\Application\Usecases;

use App\Features\EstateUtilityServiceInvoices\Application\Contracts\UpdateEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Application\Outputs\UpdateEstateUtilityServiceInvoiceOutput;
use App\Shared\Application\Contracts\Storage\File;
use App\Shared\Application\Contracts\Storage\Storage;
use App\Shared\Application\Contracts\Storage\StorageDir;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceInvoiceEntity;
use App\Shared\Domain\Repositories\EstateUtilityServiceInvoiceRepository;
use Exception;

final class UpdateEstateUtilityServiceInvoiceUsecase implements UpdateEstateUtilityServiceInvoiceContract
{
    public function __construct(
        private readonly Storage $storage,
        private readonly StorageDir $storageDir,
        private readonly EstateUtilityServiceInvoiceRepository $estateUtilityServiceInvoiceRepository
    ) {}
    public function execute(EstateUtilityServiceInvoiceEntity $estateUtilityServiceInvoiceEntity, ?File $file ,UpdateEstateUtilityServiceInvoiceOutput $presenter): void
    {
        try {
            //is file updated 
            if ($file) {
                $oldFile = $this->estateUtilityServiceInvoiceRepository->show($estateUtilityServiceInvoiceEntity->id)->file;
                $storageDir = $this->storageDir->estateUtilityServicesInvoice(
                    $estateUtilityServiceInvoiceEntity->estate->id,
                    $estateUtilityServiceInvoiceEntity->estateUtilityServiceId
                );
                //remove old file
                $this->storage->remove($storageDir . $oldFile);
                //save new file
                $estateUtilityServiceInvoiceEntity->file = $this->storage->store($storageDir, $file);
            }
            $status = $this->estateUtilityServiceInvoiceRepository->update($estateUtilityServiceInvoiceEntity);
            $presenter->onSuccess($status);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
