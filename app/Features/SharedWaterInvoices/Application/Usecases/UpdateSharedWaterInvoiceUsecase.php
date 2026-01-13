<?php
declare (strict_types=1);
namespace App\Features\SharedWaterInvoices\Application\Usecases;

use App\Features\SharedWaterInvoices\Application\Contracts\UpdateSharedWaterInvoiceContract;
use App\Features\SharedWaterInvoices\Application\Outputs\UpdateSharedWaterInvoiceOutput;
use App\Shared\Domain\Entities\SharedWaterInvoice\SharedWaterInvoiceEntity;
use App\Shared\Domain\Repositories\SharedWaterInvoiceRepository;
use App\Shared\Domain\Repositories\TransactionRepository;
use Exception;

final class UpdateSharedWaterInvoiceUsecase implements UpdateSharedWaterInvoiceContract {
    public function __construct(
        private readonly TransactionRepository $transactionRepository,
    ) { }
    public function exectute (SharedWaterInvoiceEntity $sharedWaterInvoiceEntity, UpdateSharedWaterInvoiceOutput $presenter):void{
        try{
            $status = $this->transactionRepository->update($sharedWaterInvoiceEntity->transaction);
            $presenter->onSuccess($status);
        }catch (Exception $e){
            $presenter->onFailure($e->getMessage());
        }
    }
}
