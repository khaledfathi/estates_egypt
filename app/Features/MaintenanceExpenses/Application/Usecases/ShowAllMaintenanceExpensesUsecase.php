<?php
declare(strict_types=1);

namespace App\Features\MaintenanceExpenses\Application\Usecases;

use App\Features\MaintenanceExpenses\Application\Contracts\ShowAllMaintenanceExpensesContract;
use App\Features\MaintenanceExpenses\Application\Outputs\ShowAllMaintenanceExpensesOutput;
use App\Shared\Domain\Repositories\EstateRepositroy;
use Exception;

final class ShowAllMaintenanceExpensesUsecase implements ShowAllMaintenanceExpensesContract{
    public function __construct(
        private readonly EstateRepositroy $estateRepositroy, 
    ) {}
    public function execute(ShowAllMaintenanceExpensesOutput $presenter){
        try {
            $estateEntities= $this->estateRepositroy->index();
            $presenter->onSuccess($estateEntities);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}