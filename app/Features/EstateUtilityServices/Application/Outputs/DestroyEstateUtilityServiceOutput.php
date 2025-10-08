<?php
declare(strict_types=1);
namespace App\Features\EstateUtilityServices\Application\Outputs;

interface DestroyEstateUtilityServiceOutput {

    public function onSuccess(bool $status ): void;
    public function onFailure($error):void;
}