<?php

declare(strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Presentation\Http\Presenters;

use App\Features\EstateMaintenanceExpenses\Application\Outputs\EditEstateMaintenanceExpensesOutput;
use App\Shared\Domain\Entities\Estate\EstateMaintenanceExpensesEntity;
use Closure;

final class EditEstateMaintenanceExpensesPresenter implements EditEstateMaintenanceExpensesOutput
{

    private Closure $response;
    public function onSuccess(EstateMaintenanceExpensesEntity $estateMaintenanceExpensesEntity): void
    {
        $data = [
            'estate' => $estateMaintenanceExpensesEntity->estate,
            'estateMaintenanceExpense' => $estateMaintenanceExpensesEntity,
        ];
        $this->response = fn() => view('estates.maintenance-expenses::edit', $data);
    }
    public function onNotFound(): void
    {
        dd('not found');
    }
    public function onFailure(string $error): void
    {
        dd('failure', $error);
    }
    public function handle()
    {
        return ($this->response)();
    }
}
