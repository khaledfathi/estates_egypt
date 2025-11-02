<?php
declare (strict_types=1);

namespace App\Features\UnitContracts\Application\Ouputs;


interface UpdateUnitContractOutput{
    public function onSuccess(bool $status):void;
    public function onFailure(string $error):void;
}