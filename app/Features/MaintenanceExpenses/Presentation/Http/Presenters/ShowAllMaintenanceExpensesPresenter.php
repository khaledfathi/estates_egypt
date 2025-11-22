<?php

declare(strict_types=1);

namespace App\Features\MaintenanceExpenses\Presentation\Http\Presenters;

use App\Features\MaintenanceExpenses\Application\Outputs\ShowAllMaintenanceExpensesOutput;
use Closure;

final class ShowAllMaintenanceExpensesPresenter implements ShowAllMaintenanceExpensesOutput
{
    private Closure $response;
    /**
     * @inheritdoc
     */
    public function onSuccess(array $estateEntities): void
    {
        $this->response = fn() => view('maintenance-expenses::index', [
            'estates' => $estateEntities
        ]);
    }
    public function onFailure(string $error): void
    {
        dd('error', $error);
    }

    public function handle()
    {
        return ($this->response)();
    }
}
