<?php
declare (strict_types= 1);
namespace App\Features\Units\Application\Ouputs;

interface DestroyUnitOutput {
    public function onSuccess(bool $status ): void;
    public function onFailure($error):void;
}

