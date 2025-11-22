<?php
declare (strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Application\Usecases;

use App\Features\EstateMaintenanceExpenses\Application\Contracts\CreateEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Outputs\CreateEstateMaintenanceExpensesOutput;
use App\Shared\Domain\Repositories\EstateRepositroy;
use Exception;

final class CreateEstateMaintenanceExpensesUsecase implements CreateEstateMaintenanceExpensesContract{
    public function __construct(
        private readonly EstateRepositroy $estateRepositroy,
    ){}
    public function execute(int $estateId ,  CreateEstateMaintenanceExpensesOutput $presenter ):void{
        try {
            $estateEntitiy = $this->estateRepositroy->show($estateId);
            $estateEntitiy 
                ? $presenter->onSuccess($estateEntitiy)
                : $presenter->onEstateNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}