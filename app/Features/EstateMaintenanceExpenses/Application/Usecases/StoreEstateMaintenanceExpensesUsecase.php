<?php
declare (strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Application\Usecases;

use App\Features\EstateMaintenanceExpenses\Application\Contracts\StoreEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Outputs\StoreEstateMaintenanceExpensesOutput;
use App\Shared\Domain\Entities\Estate\EstateMaintenanceExpensesEntity;
use App\Shared\Domain\Repositories\EstateMaintenanceExpensesRepository;
use App\Shared\Domain\Repositories\TransactionRepository;
use Exception;

final class StoreEstateMaintenanceExpensesUsecase implements StoreEstateMaintenanceExpensesContract{
    public function __construct(
        private readonly EstateMaintenanceExpensesRepository $estateMaintenanceExpensesRepository,
        private readonly TransactionRepository $transactionRepository,
    ) { }
    public function execute(EstateMaintenanceExpensesEntity $estateMaintenanceExpensesEntity, StoreEstateMaintenanceExpensesOutput $presenter ):void{
        $transactionEntity = null;
        try {
            $transactionEntity = $this->transactionRepository->store($estateMaintenanceExpensesEntity->transaction);
            $estateMaintenanceExpensesEntity = $this->estateMaintenanceExpensesRepository->store($estateMaintenanceExpensesEntity);
            $presenter->onSuccess($estateMaintenanceExpensesEntity);
        } catch (Exception $e) {
            if($transactionEntity) $this->transactionRepository->destroy($transactionEntity->id);
            $presenter->onFailure($e->getMessage());
        }
    }
}