<?php

declare(strict_types=1);

namespace App\Features\AccountingManagement\Presentation\Http\Controllers;

use App\Features\AccountingManagement\Application\Contracts\ShowAllAccountingManagementContract;
use App\Features\AccountingManagement\Presentation\Http\Presenters\ShowAllAccountingManagementPresenter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountingManagementController extends Controller
{
    public function __construct(
        private readonly ShowAllAccountingManagementContract $maintenanceExpensesUsecase,
    ) {}
    public function index()
    {
        $presenter = new ShowAllAccountingManagementPresenter();
        $this->maintenanceExpensesUsecase->execute($presenter);
        return $presenter->handle();
    }
    public function show() {}
    public function store() {}
    public function edit() {}
    public function update() {}
    public function destroy() {}
}
