<?php

declare(strict_types=1);

namespace App\Features\SharedWaterInvoices\Presentation\Http\Presenters;

use App\Features\SharedWaterInvoices\Application\Outputs\EditSharedWaterInvoiceOutput;
use App\Shared\Application\Utility\Month;
use App\Shared\Domain\Entities\SharedWaterInvoice\SharedWaterInvoiceEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class EditSharedWaterInvoicePresenter implements EditSharedWaterInvoiceOutput
{
    private Closure $response;
    private string $previousURL;
    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $previousPage = SessionKeys::SHARED_WATER_INVOICE_EDIT_PREVIOUS_PAGE;
        $this->previousURL = session($previousPage)
            ?? url()->previous();
    }
    public function onSuccess(SharedWaterInvoiceEntity $sharedWaterInvoiceEntity): void
    {
        $data = [
            'sharedWaterInvoice' => $sharedWaterInvoiceEntity,
            'unitContract' => $sharedWaterInvoiceEntity->unitContract,
            'renter' => $sharedWaterInvoiceEntity->unitContract->renter,
            'unit' => $sharedWaterInvoiceEntity->unitContract->unit,
            'estate' => $sharedWaterInvoiceEntity->unitContract->unit->estate,
            'months' => Month::list(),
            'previousURL' => $this->previousURL,
        ];
        $this->response = fn() => view('shared-water-invoices::edit', $data);
    }
    public function onNotFound(): void
    {
        $this->response = fn() => view('shared-water-invoices::edit', [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error): void
    {
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
