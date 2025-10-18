<?php
declare(strict_types=1);
namespace App\Features\Owners\Application\Contracts;

use App\Features\Owners\Application\Outputs\CreateOwnerOutput;

interface CreateOwnerContract {
    public function execute (CreateOwnerOutput $presenter): void;
}