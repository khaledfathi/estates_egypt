<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServiceInvoices\Presentation\Http\Presenters;

use App\Features\EstateUtilityServiceInvoices\Application\Outputs\EditEstateUtilityServiceInvoiceOutput;
use App\Shared\Application\Utility\Month;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceInvoiceEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Log;

final class EditEstateUtilityServiceInvoicePresenter implements EditEstateUtilityServiceInvoiceOutput
{
    private Closure $response;
    public function onSuccess(EstateUtilityServiceInvoiceEntity $estateUtilityServiceInvoiceEntity): void {
        $data = [
            'estate'=> $estateUtilityServiceInvoiceEntity->estate,
            'estateUtilityService'=> $estateUtilityServiceInvoiceEntity->estateUtilityService,
            'invoice'=> $estateUtilityServiceInvoiceEntity,
            'currentYear'=> Carbon::now()->year,
            'months'=>Month::list(),
            'currentMonth'=>Month::from(Carbon::now()->month),
        ];
        $this->response = fn() => view('estates.utility-service-invoices::edit', $data);
    }
    public function onNotFound(): void {
      $this->response = fn() => view("units::edit", [
         'found' => false,
         'error' => Messages::DATA_NOT_FOUND,
      ]);
    }
    public function onFailure(string $error): void {
      $this->response = fn() => back()->withErrors([
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
