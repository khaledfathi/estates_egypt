<?php
declare(strict_types=1);

namespace App\Features\AccountingManagement\Application\Usecases;

use App\Features\AccountingManagement\Application\Contracts\ShowAllAccountingManagementContract;
use App\Features\AccountingManagement\Application\Outputs\ShowAllAccountingManagementOutput;
use App\Shared\Domain\Repositories\EstateRepositroy;
use Exception;

final class ShowAllAccountingManagementUsecase implements ShowAllAccountingManagementContract{
    public function __construct(
        private readonly EstateRepositroy $estateRepositroy, 
    ) {}
    public function execute(ShowAllAccountingManagementOutput $presenter){
        try {
            $estateEntities= $this->estateRepositroy->index();
            $presenter->onSuccess($estateEntities);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}