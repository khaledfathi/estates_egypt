<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServiceInvoices\Application\Usecases;

use App\Features\EstateUtilityServiceInvoices\Application\Contracts\StoreEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Application\Outputs\StoreEstateUtilityServiceInvoiceOutput;
use App\Shared\Application\Contracts\Storage\File;
use App\Shared\Application\Contracts\Storage\Storage;
use App\Shared\Application\Contracts\Storage\StorageDir;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceInvoiceEntity;
use App\Shared\Domain\Enum\Unit\UnitUtilityServiceType;
use App\Shared\Domain\Repositories\EstateUtilityServiceInvoiceRepository;
use App\Shared\Domain\Repositories\EstateUtilityServiceRepository;
use App\Shared\Domain\Repositories\UnitContractRepository;
use Exception;

class StoreEstateUtilityServiceInvoiceUsecase implements StoreEstateUtilityServiceInvoiceContract
{
    public function __construct(
        private readonly EstateUtilityServiceInvoiceRepository $estateUtilityServiceInvoiceRepository,
        private readonly EstateUtilityServiceRepository $estateUtilityServiceRepository,
        private readonly UnitContractRepository $unitContractRepository, 
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

            //######### Distribute water Invoices to all active unit contracts 
            $utilityService = $this->estateUtilityServiceRepository->show($estateUtilityServiceInvoiceEntity->estateUtilityServiceId);
            if($utilityService->type->value === UnitUtilityServiceType::WATER->value){
                //LOGIC for distribute the invoice value across units that has unexpired contract
                // $activeContracts = $this->unitContractRepository->getAllActiveByEstateId ($estateUtilityServiceInvoiceEntity->estateUtilityServiceId); 
                $this->unitContractRepository->sumActiveWaterInvoicesPrecentageByEstateId($estateUtilityServiceInvoiceEntity->estateUtilityServiceId);
                //0-  
                //1- query all contracts (estateid , endDate<current date ) -> get all water invoice ratios`
            }
            // #########

            $presenter->onSuccess($record);
        } catch (Exception $e) {
            //remove file if upladed 
            if ($dir && $fileName) $file = $this->storage->remove($dir . $fileName);
            // ---
            $presenter->onFailure($e->getMessage());
        }
    }
}
