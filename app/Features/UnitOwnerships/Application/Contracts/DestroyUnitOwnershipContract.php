<?php
declare(strict_types=1);
namespace App\Features\UnitOwnerships\Application\Contracts;

use App\Features\UnitOwnerships\Application\Outputs\DestroyUnitOwnershipOutput;

interface DestroyUnitOwnershipContract {
    public function destroy(int $unitOwnershipId , DestroyUnitOwnershipOutput $presenter):void;
}