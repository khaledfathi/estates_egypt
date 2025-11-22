<?php
declare (strict_types=1);
namespace App\Features\EstateMaintenanceExpenses\Application\Usecases;

use App\Features\EstateMaintenanceExpenses\Application\Contracts\ShowEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Outputs\ShowEstateMaintenanceExpensesOutput;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentEstateMaintenanceExpensesRepository;
use Exception;

final class ShowEstateMaintenanceExpensesUsecase implements ShowEstateMaintenanceExpensesContract {
    public function __construct(
        private readonly EloquentEstateMaintenanceExpensesRepository $eloquentEstateMaintenanceExpensesRepository,
    ){}
    public function execute(int $estateMaintenanceExpenseId , ShowEstateMaintenanceExpensesOutput $presenter){
        try {
            $record = $this->eloquentEstateMaintenanceExpensesRepository->show($estateMaintenanceExpenseId);
            $record 
                ? $presenter->onSuccess($record)
                : $presenter->onNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}