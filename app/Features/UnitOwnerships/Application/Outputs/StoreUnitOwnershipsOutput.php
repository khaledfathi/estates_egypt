<?php
declare(strict_types=1);
namespace App\Features\UnitOwnerships\Application\Outputs;

use App\Shared\Domain\Entities\Unit\UnitOwnershipEntity;

interface StoreUnitOwnershipsOutput {
    /**
     *  
     * @param array<UnitOwnershipEntity> $unitOwnershipEntities
     * @return void
     */
    public function onSuccess (array $unitOwnershipEntities):void;
    public function onFailure (string $error):void;
}