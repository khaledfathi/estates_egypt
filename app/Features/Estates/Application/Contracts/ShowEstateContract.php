<?php
declare(strict_types=1);

namespace App\Features\Estates\Application\Contracts;

use App\Features\Estates\Application\Outputs\ShowEstateOutput;

interface ShowEstateContract {

    public function execute (int $estateId , ShowEstateOutput $presenter):void;
}