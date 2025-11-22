<?php

declare(strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Application\Usecases;

use App\Features\EstateMaintenanceExpenses\Application\Contracts\DestroyEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Outputs\DestroyEstateMaintenanceExpensesOutput;
use App\Shared\Domain\Repositories\EstateMaintenanceExpensesRepository;
use App\Shared\Domain\Repositories\TransactionRepository;
use Exception;

final class DestroyEstateMaintenanceExpensesUsecase implements DestroyEstateMaintenanceExpensesContract
{
    public function __construct(
        private readonly EstateMaintenanceExpensesRepository $estateMaintenanceExpensesRepository,
        private readonly TransactionRepository $transactionRepository,
    ) {}
    public function execute(int $estateMaintenanceExpensesId, DestroyEstateMaintenanceExpensesOutput $presenter)
    {
        try {
            $estateMaintenanceExpensesEntity = $this->estateMaintenanceExpensesRepository->show($estateMaintenanceExpensesId);
            if ($estateMaintenanceExpensesEntity) {
                $this->estateMaintenanceExpensesRepository->destroy($estateMaintenanceExpensesId);
                $this->transactionRepository->destroy($estateMaintenanceExpensesEntity->transaction->id);
                $presenter->onSuccess(true);
            }
            $presenter->onSuccess(false);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
