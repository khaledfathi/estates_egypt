<?php
declare (strict_types=1);

namespace App\Features\UnitUtilityServices\Application\Outputs;

interface DestroyUnitUtilityServiceOutput {
    public function onSuccess(bool $status):void;
    public function onFailure(string $error):void;
}