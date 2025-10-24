<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServiceInvoices\Application\Contracts;

use App\Features\EstateUtilityServiceInvoices\Application\Outputs\UpdateEstateUtilityServiceInvoiceOutput;
use App\Shared\Application\Contracts\Storage\File;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceInvoiceEntity;

interface  UpdateEstateUtilityServiceInvoiceContract
{
    public function execute(EstateUtilityServiceInvoiceEntity $estateUtilityServiceInvoiceEntity, ?File $file, UpdateEstateUtilityServiceInvoiceOutput $presenter): void;
}
