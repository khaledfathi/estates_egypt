<?php
declare(strict_types=1);
namespace App\Features\UnitOwnerships\Application\Outputs;

use App\Shared\Domain\Entities\Unit\UnitOwnershipEntity;

interface StoreUnitOwnershipOutput {
    public function onSuccess (UnitOwnershipEntity $unitOwnershipEntity):void;
    public function onFailure (string $error):void;
}