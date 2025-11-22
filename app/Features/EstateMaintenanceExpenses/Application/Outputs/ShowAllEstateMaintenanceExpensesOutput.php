<?php
declare (strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Application\Outputs;

use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\Entities\Estate\EstateMaintenanceExpensesEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface ShowAllEstateMaintenanceExpensesOutput {
    /**
     * @param EntitiesWithPagination<EstateMaintenanceExpensesEntity> $entitiesWithPagination
     * @return void
     */
    public function onSucess(EstateEntity $estateEntity,  EntitiesWithPagination $entitiesWithPagination): void;
    public function onEstaetNotFound():void;
    public function onFailure (string $error):void;

}