<?php
declare(strict_types=1);

namespace App\Features\Owners\Application\Contracts;

use App\Features\Owners\Application\Outputs\ShowOwnerOutput;

interface ShowOwnerContract
{
    public function execute(int $ownerId , ShowOwnerOutput $presenter):void;
}
