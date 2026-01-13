<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServiceInvoices\Application\Usecases;

use App\Features\EstateUtilityServiceInvoices\Application\Contracts\DestroyEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Application\Outputs\DestroyEstateUtilityServiceInvoiceOutput;
use App\Shared\Application\Contracts\Storage\Storage;
use App\Shared\Application\Contracts\Storage\StorageDir;
use App\Shared\Domain\Enum\Estate\EstateUtilityServiceType;
use App\Shared\Domain\Repositories\EstateUtilityServiceInvoiceRepository;
use App\Shared\Domain\Repositories\SharedWaterInvoiceRepository;
use App\Shared\Domain\Repositories\TransactionRepository;
use App\Shared\Infrastructure\Models\SharedWaterInvoice\SharedWaterInvoice;
use Exception;

final class DestroyEstateUtilityServiceInvoiceUsecase implements DestroyEstateUtilityServiceInvoiceContract
{

    public function __construct(
        private readonly EstateUtilityServiceInvoiceRepository $estateUtilityServiceInvoiceRepository,
        private readonly SharedWaterInvoiceRepository $sharedWaterInvoiceRepository,
        private readonly TransactionRepository $transactionRepository, 
        private readonly StorageDir $storageDir,
        private readonly Storage $storage
    ) {}
    public function execute(int $estateUtilityServiceInvoiceId, DestroyEstateUtilityServiceInvoiceOutput $presenter): void
    {
        try {
            //get record to get file name 
            $invoiceRecord = $this->estateUtilityServiceInvoiceRepository->show($estateUtilityServiceInvoiceId);
            //remove file 
            if ($invoiceRecord->file) {
                $this->storage->remove($this->storageDir->estateUtilityServicesInvoice($invoiceRecord->estate->id, $invoiceRecord->estateUtilityServiceId) . $invoiceRecord->file);
            }
            //destroy transaction releated 
            if($invoiceRecord->estateUtilityService->type == EstateUtilityServiceType::WATER){
                $this->deleteSharedWaterInvoices($estateUtilityServiceInvoiceId);
            }
            //destroy record
            $destroyInvoiceStatus = $this->estateUtilityServiceInvoiceRepository->destroy($estateUtilityServiceInvoiceId);
            //
            $presenter->onSuccess($destroyInvoiceStatus);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
    /**
     * delete shared water invoices with its transactions 
     * @return void 
     */
    private function deleteSharedWaterInvoices(int $estateUtilityServiceInvoiceId):void{
        $sharedWaterInvoiceEntities = $this->sharedWaterInvoiceRepository->showByUtilityServiceInvoiceId($estateUtilityServiceInvoiceId);
        $transactionsIds = array_map(fn($invoice)=> $invoice->transactionId, $sharedWaterInvoiceEntities);
        $this->transactionRepository->destroyMany($transactionsIds);
    } 

}
