<?php
declare(strict_types= 1);

namespace App\Features\Renters\Application\Outputs;

interface DestroyRenterOutput{

    public function onSuccess(bool $status):void;
    public function onFailure(string $error ):void;
}