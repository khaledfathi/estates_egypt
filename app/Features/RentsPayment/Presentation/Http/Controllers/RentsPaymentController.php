<?php
declare (strict_types= 1);
namespace App\Features\RentsPayment\Presentation\Http\Controllers;

use App\Features\RentsPayment\Application\Usecase\ShowAllRentersPaymentContract;
use App\Features\RentsPayment\Presentation\Http\Presenters\ShowAllRentersPaymentPresenter;
use App\Http\Controllers\Controller;

class RentsPaymentController extends Controller
{
    public function __construct(
        private readonly ShowAllRentersPaymentContract $showAllRentersPaymentUsecase,
    ) { }   
    public function index(string $estateId , string $unitId , string $contractId )
    {
        $presenter = new ShowAllRentersPaymentPresenter();
        $this->showAllRentersPaymentUsecase->execute((int)$contractId , $presenter);
        return $presenter->handle();
    }
    public function show()
    {
        return  __CLASS__."::".__FUNCTION__;
    }
    public function create()
    {
        return  __CLASS__."::".__FUNCTION__;
    }
    public function store()
    {
        return  __CLASS__."::".__FUNCTION__;
    }
    public function edit()
    {
        return  __CLASS__."::".__FUNCTION__;
    }
    public function update()
    {
        return  __CLASS__."::".__FUNCTION__;
    }
    public function destroy()
    {
        return  __CLASS__."::".__FUNCTION__;
    }
}
