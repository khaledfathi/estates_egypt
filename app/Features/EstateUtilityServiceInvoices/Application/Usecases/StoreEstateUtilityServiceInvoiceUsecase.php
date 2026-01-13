<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServiceInvoices\Application\Usecases;

use App\Features\EstateUtilityServiceInvoices\Application\Contracts\StoreEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Application\Outputs\StoreEstateUtilityServiceInvoiceOutput;
use App\Shared\Application\Contracts\Storage\File;
use App\Shared\Application\Contracts\Storage\Storage;
use App\Shared\Application\Contracts\Storage\StorageDir;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceInvoiceEntity;
use App\Shared\Domain\Entities\SharedWaterInvoice\SharedWaterInvoiceEntity;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Domain\Enum\Unit\UnitUtilityServiceType;
use App\Shared\Domain\Repositories\EstateUtilityServiceInvoiceRepository;
use App\Shared\Domain\Repositories\EstateUtilityServiceRepository;
use App\Shared\Domain\Repositories\SharedWaterInvoiceRepository;
use App\Shared\Domain\Repositories\TransactionRepository;
use App\Shared\Domain\Repositories\UnitContractRepository;
use App\Shared\Infrastructure\Utilities\CarbonDateUtility;
use Exception;

class StoreEstateUtilityServiceInvoiceUsecase implements StoreEstateUtilityServiceInvoiceContract
{
    private readonly EstateUtilityServiceInvoiceEntity $utilityServiceInvoice;
    public function __construct(
        private readonly EstateUtilityServiceInvoiceRepository $estateUtilityServiceInvoiceRepository,
        private readonly EstateUtilityServiceRepository $estateUtilityServiceRepository,
        private readonly UnitContractRepository $unitContractRepository,
        private readonly SharedWaterInvoiceRepository $sharedWaterInvoiceRepository,
        private readonly TransactionRepository $transactionRepository,
        private readonly StorageDir $storageDir,
        private readonly Storage $storage,
    ) {}
    public function execute(
        EstateUtilityServiceInvoiceEntity $estateUtilityServiceInvoiceEntity,
        ?File $file,
        StoreEstateUtilityServiceInvoiceOutput $presenter
    ): void {
        $this->utilityServiceInvoice = $estateUtilityServiceInvoiceEntity;
        $fileName = null;
        $dir = null;
        try {
            //store file 
            if ($file) {
                $dir = $this->storageDir->estateUtilityServicesInvoice(
                    $this->utilityServiceInvoice->estate->id,
                    $this->utilityServiceInvoice->estateUtilityServiceId
                );
                $fileName = $this->storage->store($dir, $file);
                $this->utilityServiceInvoice->file = $fileName;
            }
            //store estate utility service invoice data 
            $invoiceEntity = $this->estateUtilityServiceInvoiceRepository->store($estateUtilityServiceInvoiceEntity);
            //Distribute water Invoices to all active unit contracts 
            $this->distributeInvoices();
            //
            $presenter->onSuccess($invoiceEntity);
        } catch (Exception $e) {
            //remove file if upladed 
            if ($dir && $fileName) $file = $this->storage->remove($dir . $fileName);
            // ---
            $presenter->onFailure($e->getMessage());
        }
    }
    /**
     * distibute invoice over all active units (with active contracts) 
     * Equation for each unit : (invoice_value / total_unit_equivalents) * unit_equivalent
     * @return void
     */
    private function distributeInvoices()
    {
        // get required data
        $utilityServiceType = $this->estateUtilityServiceRepository->show($this->utilityServiceInvoice->estateUtilityServiceId)->type;
        $totalSharedWaterInvoicePrecentage = $this->unitContractRepository->sumActiveWaterInvoicesPrecentage($this->utilityServiceInvoice->estate->id);
        $invoiceValuePerUnit = match ($utilityServiceType->name) {
            UnitUtilityServiceType::WATER->name => $this->utilityServiceInvoice->amount / ($totalSharedWaterInvoicePrecentage > 0 ? $totalSharedWaterInvoicePrecentage : 1),
            UnitUtilityServiceType::ELECTRICITY->name => 0,
            default => 0
        };
        $activeUnitContracts = $this->unitContractRepository->getAllActive($this->utilityServiceInvoice->estate->id);
        // actions  
        foreach ($activeUnitContracts as $contract) {
            $transactionEntity  = $this->transactionRepository->store(new TransactionEntity(
                date: CarbonDateUtility::now(),
                amount: 0,
            ));
            $this->sharedWaterInvoiceRepository->store(
                new SharedWaterInvoiceEntity(
                    contractId: $contract->id,
                    utilityServiceInvioceId:$this->utilityServiceInvoice->id,
                    sharedValue: $invoiceValuePerUnit * $contract->waterInvoicePercentage,
                    forMonth: $this->utilityServiceInvoice->forMonth,
                    forYear: $this->utilityServiceInvoice->forYear,
                    transactionId: $transactionEntity->id,
                )
            );
        }
    }
}
