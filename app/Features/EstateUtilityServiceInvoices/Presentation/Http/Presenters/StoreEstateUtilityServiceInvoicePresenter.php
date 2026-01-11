<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServiceInvoices\Presentation\Http\Presenters;

use App\Features\EstateUtilityServiceInvoices\Application\Outputs\StoreEstateUtilityServiceInvoiceOutput;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceInvoiceEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class StoreEstateUtilityServiceInvoicePresenter implements StoreEstateUtilityServiceInvoiceOutput
{
    private Closure $response;
    public function __construct(
        private readonly int $estateId,
        private readonly int $utilityServiceId,
    ){}
    public function onSuccess(EstateUtilityServiceInvoiceEntity $estateUtilityServiceInvoiceEntity): void
    {
        $this->response = fn()=> redirect(route('estates.utility-services.show', [
            'estate' => $this->estateId,
            'utility_service' => $this->utilityServiceId,
        ]))->with('success' , Messages::STORE_SUCCESS);
    }
    public function onNotFound(): void
    {
        $this->response =fn()=> view("estates.utility-service-invoice::create", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => back()
            ->withInput()
            ->with('error', Messages::INTERNAL_SERVER_ERROR);
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
