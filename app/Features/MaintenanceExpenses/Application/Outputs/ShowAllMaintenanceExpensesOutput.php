<?php
declare(strict_types=1);

namespace App\Features\MaintenanceExpenses\Application\Outputs;

use App\Shared\Domain\Entities\Estate\EstateEntity;

interface ShowAllMaintenanceExpensesOutput{

    /**
     * @param array<EstateEntity> $renterEntities
     * @return void
     */
    public function onSuccess(array $estateEntities):void;
    public function onFailure(string $error):void;
}