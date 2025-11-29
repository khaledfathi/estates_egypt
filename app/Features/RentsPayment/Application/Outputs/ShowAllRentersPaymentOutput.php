<?php
declare(strict_types=1);
namespace App\Features\RentsPayment\Application\Outputs;

use App\Shared\Domain\Entities\Unit\UnitContractEntity;

interface ShowAllRentersPaymentOutput {
    public function onSuccess (UnitContractEntity $unitContractEntity , $entitiesWithPagination):void;
    public function onContractNotFound ():void;
    public function onFailure(string $error):void;
}

