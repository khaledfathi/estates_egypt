<?php

declare(strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Application\Usecases;

use App\Features\EstateMaintenanceExpenses\Application\Contracts\EditEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Outputs\EditEstateMaintenanceExpensesOutput;
use App\Shared\Domain\Repositories\EstateMaintenanceExpensesRepository;
use Exception;

final class EditEstateMaintenanceExpensesUsecase implements EditEstateMaintenanceExpensesContract
{
    public function __construct(
        private readonly EstateMaintenanceExpensesRepository $estateMaintenanceExpensesRepository,
    ) {}
    public function execute(int $estateMaintenanceExpenseId, EditEstateMaintenanceExpensesOutput $presenter)
    {
        try {
            $record = $this->estateMaintenanceExpensesRepository->show($estateMaintenanceExpenseId);
            $record
                ? $presenter->onSuccess($record)
                :  $presenter->onNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
