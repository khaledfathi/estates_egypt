<?php

declare(strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Presentation\Http\Presenters;

use App\Features\EstateMaintenanceExpenses\Application\Outputs\StoreEstateMaintenanceExpensesOutput;
use App\Shared\Domain\Entities\Estate\EstateMaintenanceExpensesEntity;
use App\Shared\Presentation\Constants\Messages;
use Closure;

final class StoreEstateMaintenanceExpensesPresenter implements StoreEstateMaintenanceExpensesOutput
{
    private Closure $response;
    public function onSuccess(EstateMaintenanceExpensesEntity $estateMaintenanceExpensesEntity): void
    {
        $this->response = fn() => redirect(
            route('estates-maintenance-expenses.index', ['estate_id' => $estateMaintenanceExpensesEntity->estateId])
        )->with('success', Messages::STORE_SUCCESS);
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
