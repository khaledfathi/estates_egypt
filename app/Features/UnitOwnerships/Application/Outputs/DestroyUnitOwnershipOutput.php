<?php
declare (strict_types=1);
namespace App\Features\UnitOwnerships\Application\Outputs;

interface DestroyUnitOwnershipOutput {
    public function onSuccess (bool $status):void;
    public function onFailure (string $error):void;
}