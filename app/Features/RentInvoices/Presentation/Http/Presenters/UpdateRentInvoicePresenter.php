<?php

declare(strict_types=1);

namespace  App\Features\RentInvoices\Presentation\Http\Presenters;

use App\Features\RentInvoices\Application\Outputs\UpdateRentInvoiceOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class UpdateRentInvoicePresenter implements UpdateRentInvoiceOutput
{
    private Closure $response;
    private $lastPage;
    public function __construct() { 
        $this->handleSession();
    }
    private function handleSession()
    {
        $this->lastPage = session(SessionKeys::RENT_INVOICE_EDIT_PREVIOUS_PAGE);
    }
    public function onSuccess(bool $status): void
    {
        $this->response = fn() => redirect($this->lastPage)
            ->with('success', Messages::UPDATE_SUCCESS);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => back()->with( [
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
