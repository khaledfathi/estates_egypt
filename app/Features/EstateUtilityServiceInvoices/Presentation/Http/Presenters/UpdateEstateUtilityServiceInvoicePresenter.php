<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServiceInvoices\Presentation\Http\Presenters;

use App\Features\EstateUtilityServiceInvoices\Application\Outputs\UpdateEstateUtilityServiceInvoiceOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Illuminate\Support\Facades\Log;

final class UpdateEstateUtilityServiceInvoicePresenter implements UpdateEstateUtilityServiceInvoiceOutput
{

    private \Closure $response;
    public  function __construct(
        private readonly int $estateId,
        private readonly int $utilityServiceId,
    ) {}
    public function onSuccess(bool $status): void
    {
        $this->response =  fn() =>   redirect(route('estates.utility-services.show', [
            'estate' => $this->estateId,
            'utility_service' =>  $this->utilityServiceId,
        ]))->with('success', Messages::UPDATE_SUCCESS);
    }
    public function onFailure($error): void
    {
        $this->response = fn() =>
        redirect()->back()->withErrors(Messages::INTERNAL_SERVER_ERROR);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }
    public function handle()
    {
        return ($this->response)();
    }
}
