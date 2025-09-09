<?php
declare(strict_types= 1);

namespace App\Features\Owners\Application\Outputs;

interface  UpdateOwnerOutput{
    public function onSuccess (bool $status):void ;
    public function onFailure (string $error):void ;
}