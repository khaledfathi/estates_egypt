<?php

declare(strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Application\Usecases;

use App\Features\EstateMaintenanceExpenses\Application\Contracts\ShowAllEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Outputs\ShowAllEstateMaintenanceExpensesOutput;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentEstateMaintenanceExpensesRepository;
use Exception;

final class ShowAllEstateMaintenanceExpensesUsecase implements ShowAllEstateMaintenanceExpensesContract
{
    public function __construct(
        private readonly EstateRepositroy $estateRepositroy,
        private readonly EloquentEstateMaintenanceExpensesRepository $estateMaintenanceExpensesRepository
    ) { }
    public function execute(int $estateId, int $year ,ShowAllEstateMaintenanceExpensesOutput $presenter, int $perPage=10): void {
        try {
            $estateEntity = $this->estateRepositroy->show($estateId);
            if($estateEntity){
                $entitiesWithPagination = $this->estateMaintenanceExpensesRepository->indexWithPaginateByEstateIdAndYear($estateId , $year,$perPage);
                $presenter->onSucess($estateEntity ,$entitiesWithPagination);
            }else {
                $presenter->onEstaetNotFound();
            }
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
