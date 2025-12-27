<?php

declare(strict_types=1);

namespace App\Features\SharedWaterInvoices\Presentation\Http\Controllers;

use App\Features\SharedWaterInvoices\Application\Contracts\ShowAllSharedWaterInvoiceContract;
use App\Features\SharedWaterInvoices\Presentation\Http\Presenters\ShowAllSharedWaterInvoicePresenter;
use Carbon\Carbon;

class SharedWaterInvoiceController
{
    public function __construct(
        private readonly ShowAllSharedWaterInvoiceContract $showAllSharedWaterInvoiceUsecase,
    ) {}
    public function index(string $estateId, string $unitId, string $contractId)
    {
        //prepare 
        $year= (int)($request->year ?? Carbon::now()->year);
        //action
        $presenter = new ShowAllSharedWaterInvoicePresenter();
        $this->showAllSharedWaterInvoiceUsecase->execute((int)$contractId, $year, $presenter);
        return $presenter->handle();
    }
    public function show()
    {
        return __CLASS__ . "::" . __FUNCTION__;
    }
    public function create()
    {
        return __CLASS__ . "::" . __FUNCTION__;
    }
    public function  store()
    {
        return __CLASS__ . "::" . __FUNCTION__;
    }
    public function edit()
    {
        return __CLASS__ . "::" . __FUNCTION__;
    }
    public function update()
    {
        return __CLASS__ . "::" . __FUNCTION__;
    }
    public function destroy()
    {
        return __CLASS__ . "::" . __FUNCTION__;
    }
}
