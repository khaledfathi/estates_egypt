<?php

declare(strict_types=1);

namespace App\Features\MaintenanceExpenses\Presentation\Http\Controllers;

use App\Features\MaintenanceExpenses\Application\Contracts\ShowAllMaintenanceExpensesContract;
use App\Features\MaintenanceExpenses\Presentation\Http\Presenters\ShowAllMaintenanceExpensesPresenter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaintenanceExpensesController extends Controller
{
    public function __construct(
        private readonly ShowAllMaintenanceExpensesContract $maintenanceExpensesUsecase,
    ) {}
    public function index()
    {
        $presenter = new ShowAllMaintenanceExpensesPresenter();
        $this->maintenanceExpensesUsecase->execute($presenter);
        return $presenter->handle();
    }
    public function show() {}
    public function store() {}
    public function edit() {}
    public function update() {}
    public function destroy() {}
}
