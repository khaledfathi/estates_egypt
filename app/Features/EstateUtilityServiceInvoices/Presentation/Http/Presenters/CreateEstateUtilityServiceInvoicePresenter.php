<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServiceInvoices\Presentation\Http\Presenters;

use App\Features\EstateUtilityServiceInvoices\Application\Outputs\CreateEstateUtilityServiceInvoiceOutput;
use App\Shared\Application\Utility\Month;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

final class CreateEstateUtilityServiceInvoicePresenter implements CreateEstateUtilityServiceInvoiceOutput
{
    private Closure $response;
    public function onSuccess(EstateUtilityServiceEntity $estateUtilityServiceEntity): void
    {
         
        $data = [
            'estate' => $estateUtilityServiceEntity->estate,
            'estateUtilityService' => $estateUtilityServiceEntity,
            'currentYear'=> Carbon::now()->year,
            'months'=>Month::list(),
            'currentMonth'=>Month::from(Carbon::now()->month),
        ];
        $this->response = fn() => view('estates.utility-service-invoices::create', data: $data);
    }
    public function onNotFound(): void
    {
        $this->response =fn()=> view("estates.utility-service-invoices::create", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn ()=> back()->withErrors([
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error,  'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }
    public function handle()
    {
        return ($this->response)();
    }
}
