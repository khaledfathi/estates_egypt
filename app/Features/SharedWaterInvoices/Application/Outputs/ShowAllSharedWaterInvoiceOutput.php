<?php
declare (strict_types=1);
namespace App\Features\SharedWaterInvoices\Application\Outputs;

use App\Shared\Domain\Entities\SharedWaterInvoice\SharedWaterInvoiceEntity;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;

interface ShowAllSharedWaterInvoiceOutput{
    /**
     * Summary of onSuccess
     * @param array<SharedWaterInvoiceEntity> $sharedWaterInvoicesEntities
     * @return void
     */

    public function onSuccess (UnitContractEntity $unitContract , array $sharedWaterInvoicesEntities):void;
    public function onContractNotFound ():void;
    public function onFailure (string $error):void;
}