<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServiceInvoices\Presentation\Http\Presenters;

use App\Features\EstateUtilityServiceInvoices\Application\Outputs\DestroyEstateUtilityServiceInvoiceOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class DestroyEstateUtilityServiceInvoicePresenter  implements DestroyEstateUtilityServiceInvoiceOutput
{

    private Closure $response;
    public function onSuccess(bool $status): void {
        $this->response = fn() => back()
            ->with('success', Messages::DESTROY_SUCCESS);
    }
    public function onFailure($error): void
    {
        $this->response = fn() => back()
            ->with('error', Messages::INTERNAL_SERVER_ERROR);
        //log
        Log::channel(LogChannels::ERROR)
            ->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
    }
    public function handle()
    {
        return ($this->response)();
    }
}
