<?php
declare (strict_types=1);
namespace App\Features\SharedWaterInvoices\Application\Usecases; 

use App\Features\SharedWaterInvoices\Application\Contracts\EditSharedWaterInvoiceContract;
use App\Features\SharedWaterInvoices\Application\Outputs\EditSharedWaterInvoiceOutput;
use App\Shared\Domain\Repositories\SharedWaterInvoiceRepository;
use Exception;

final class EditSharedWaterInvoiceUsecase  implements EditSharedWaterInvoiceContract {
    public function __construct(
        private readonly SharedWaterInvoiceRepository $sharedWaterInvoiceRepository,
    ) { }
    public function exectute (int $sharedWaterInvoiceId , EditSharedWaterInvoiceOutput $presenter):void{
        try {
            $record = $this->sharedWaterInvoiceRepository->show($sharedWaterInvoiceId);
            $record
                ? $presenter->onSuccess($record)
                : $presenter->onNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
