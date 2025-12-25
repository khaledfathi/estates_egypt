<?php

declare(strict_types=1);

namespace App\Features\RentInvoices\Presentation\Http\Presenters;

use App\Features\RentInvoices\Application\Outputs\ShowRentInvoiceOutput;
use App\Shared\Domain\Entities\RentsPayment\RentInvoiceEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowRentInvoicePresenter implements ShowRentInvoiceOutput
{
    private Closure $response;

    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $previousPage = SessionKeys::RENT_INVOICE_EDIT_PREVIOUS_PAGE;
        session()->put($previousPage, url()->current());
    }
    public function onSuccess(RentInvoiceEntity $rentInvoiceEntity): void
    {
        $data = [
            'rentInvoice' => $rentInvoiceEntity,
            'unitContract' => $rentInvoiceEntity->contract,
            'renter' => $rentInvoiceEntity->contract->renter,
            'unit' => $rentInvoiceEntity->contract->unit,
            'estate' => $rentInvoiceEntity->contract->unit->estate,
        ];
        $this->response = fn() => view('rent-invoices::show', $data);
    }
    public function onNotFound(): void
    {
        $this->response = fn() => view("rent-invoices::show", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => view("rent-invoices::show", [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error,  'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }
    public function  handle()
    {
        return ($this->response)();
    }
}
