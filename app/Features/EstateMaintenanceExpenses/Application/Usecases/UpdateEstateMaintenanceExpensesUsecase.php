<?php

declare(strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Application\Usecases;

use App\Features\EstateMaintenanceExpenses\Application\Contracts\UpdateEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Outputs\UpdateEstateMaintenanceExpensesOutput;
use App\Shared\Domain\Entities\Estate\EstateMaintenanceExpensesEntity;
use App\Shared\Domain\Repositories\EstateMaintenanceExpensesRepository;
use App\Shared\Domain\Repositories\TransactionRepository;
use Exception;

final class UpdateEstateMaintenanceExpensesUsecase implements UpdateEstateMaintenanceExpensesContract
{
    public function __construct(
        private readonly EstateMaintenanceExpensesRepository $estateMaintenanceExpensesRepository,
        private readonly TransactionRepository $transactionRepository,
    ) {}
    public function execute(EstateMaintenanceExpensesEntity $estateMaintenanceExpensesEntity, UpdateEstateMaintenanceExpensesOutput $presenter):void
    {
        try {
            $updateEstateMaintenanceExpenseStatus = $this->estateMaintenanceExpensesRepository->update($estateMaintenanceExpensesEntity);
            if($estateMaintenanceExpensesEntity->transaction)
                $updateTransactionStatus = $this->transactionRepository->update($estateMaintenanceExpensesEntity->transaction);
            $presenter->onSuccess($updateEstateMaintenanceExpenseStatus);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
