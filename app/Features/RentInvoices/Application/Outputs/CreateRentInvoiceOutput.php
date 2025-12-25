<?php
declare(strict_types=1);
namespace  App\Features\RentInvoices\Application\Outputs; 

use App\Shared\Domain\Entities\Unit\UnitContractEntity;

interface CreateRentInvoiceOutput{
    public function onSuccess (UnitContractEntity $unitContractEntity):void;
    public function onContractNotFound():void;
    public function onFailure(string $error):void;
}

