<?php
declare (strict_types=1);
namespace App\Features\SharedWaterInvoices\Application\Usecases;

use App\Features\SharedWaterInvoices\Application\Contracts\UpdateSharedWaterInvoiceContract;
use App\Features\SharedWaterInvoices\Application\Outputs\UpdateSharedWaterInvoiceOutput;
use App\Shared\Domain\Entities\SharedWaterInvoice\SharedWaterInvoiceEntity;
use App\Shared\Domain\Repositories\SharedWaterInvoiceRepository;
use Exception;

final class UpdateSharedWaterInvoiceUsecase implements UpdateSharedWaterInvoiceContract {
    public function __construct(
        private readonly SharedWaterInvoiceRepository $sharedWaterInvoiceRepository
    ) { }
    public function exectute (SharedWaterInvoiceEntity $sharedWaterInvoiceEntity, UpdateSharedWaterInvoiceOutput $presenter):void{
        try{
            $status = $this->sharedWaterInvoiceRepository->update($sharedWaterInvoiceEntity);
            $presenter->onSuccess($status);
        }catch (Exception $e){
            $presenter->onFailure($e->getMessage());
        }
    }
}
