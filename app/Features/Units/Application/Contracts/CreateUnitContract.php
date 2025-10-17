<?php
declare (strict_types=1);
namespace App\Features\Units\Application\Contracts;

use App\Features\Units\Application\Ouputs\CreateUnitOutput;

interface CreateUnitContract {
    public function execute(int $estateId, CreateUnitOutput $presenter):void ;
}