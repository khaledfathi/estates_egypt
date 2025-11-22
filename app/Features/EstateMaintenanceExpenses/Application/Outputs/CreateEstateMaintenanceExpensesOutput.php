<?php
declare (strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Application\Outputs;

use App\Shared\Domain\Entities\Estate\EstateEntity;

interface CreateEstateMaintenanceExpensesOutput{
    public function onSuccess (EstateEntity $estateEntity):void;
    public function onEstateNotFound():void;
    public function onFailure(string $error):void;
}