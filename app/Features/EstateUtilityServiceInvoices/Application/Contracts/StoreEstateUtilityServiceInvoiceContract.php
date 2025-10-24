<?php
declare (strict_types=1);
namespace App\Features\EstateUtilityServiceInvoices\Application\Contracts;

use App\Features\EstateUtilityServiceInvoices\Application\Outputs\StoreEstateUtilityServiceInvoiceOutput;
use App\Shared\Application\Contracts\Storage\File;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceInvoiceEntity;
interface StoreEstateUtilityServiceInvoiceContract {
    public function execute(EstateUtilityServiceInvoiceEntity $estateUtilityServiceInvoiceEntity, ?File $file , StoreEstateUtilityServiceInvoiceOutput $presenter): void ;
}

