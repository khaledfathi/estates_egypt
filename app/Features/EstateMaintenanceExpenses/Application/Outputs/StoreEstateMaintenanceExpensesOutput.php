<?php

declare(strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Application\Outputs;

use App\Shared\Domain\Entities\Estate\EstateMaintenanceExpensesEntity;
use Exception;

interface StoreEstateMaintenanceExpensesOutput
{
    public function onSuccess(EstateMaintenanceExpensesEntity $estateMaintenanceExpensesEntity): void;
    public function onFailure(string $error): void;
}
