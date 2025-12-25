<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Application\Outputs;

use App\Shared\Domain\Entities\RentsPayment\RentInvoiceEntity;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface ShowAllRentInvoicesOutput {
    /**
     * @param UnitContractEntity $unitContractEntity
     * @param EntitiesWithPagination<RentInvoiceEntity> $entitiesWithPagination
     * @return void
     */
    public function onSuccess (UnitContractEntity $unitContractEntity , EntitiesWithPagination $entitiesWithPagination):void;
    public function onContractNotFound ():void;
    public function onFailure(string $error):void;
}

