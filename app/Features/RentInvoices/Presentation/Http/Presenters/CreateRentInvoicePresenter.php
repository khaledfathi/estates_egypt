<?php
declare(strict_types=1);
namespace  App\Features\RentInvoices\Presentation\Http\Presenters;

use App\Features\RentInvoices\Application\Outputs\CreateRentInvoiceOutput;
use App\Shared\Application\Utility\Month;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Log;

final class CreateRentInvoicePresenter implements CreateRentInvoiceOutput{
    private Closure $response;
    public function onSuccess (UnitContractEntity $unitContractEntity):void{
        $data= [
            'unitContract' => $unitContractEntity,
            'renter' => $unitContractEntity->renter,
            'unit' => $unitContractEntity->unit,
            'estate' => $unitContractEntity->unit->estate,
            'currentMonth' => Month::from(Carbon::now()-> month),
            'currentYear' =>  Carbon::now()->year,
            'months' => Month::list(),
        ];
        $this->response = fn()=> view('rent-invoices::create' , $data);
    }
    public function onContractNotFound():void{
        $this->response = fn()=>view("rent-invoices::create", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error):void{
        $this->response = fn() => view('rent-invoices::create', [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)
            ->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
    }
    public function handle (){
        return ($this->response)();
    }
}

