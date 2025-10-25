<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServices\Presentation\Http\Presenters;

use App\Features\EstateUtilityServices\Application\Outputs\ShowEstateUtilityServiceOutput;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceEntity;
use App\Shared\Domain\Enum\Estate\EstateUtilityServiceType;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowEstateUtilityServicePresenter implements ShowEstateUtilityServiceOutput
{
    public Closure $response;
    public function __construct(
        private readonly ?int $invoicesYear,
    ) {
        $this->handleSession();
    }
    private function handleSession()
    {
        $previousPage = SessionKeys::estate_UTILITY_SERVICE_EDIT_PREVIOUS_PAGE;
        session()->put($previousPage, url()->current());
    }
    public function onSuccess(EstateUtilityServiceEntity $estateUtilityServiceEntity): void
    {
        $data = [
            'estate' => $estateUtilityServiceEntity->estate,
            'estateUtilityService' => $estateUtilityServiceEntity,
            'utilityServiceTypes' => EstateUtilityServiceType::labels(),
            'utilityServiceInvoices' => $estateUtilityServiceEntity->invoices,
            'currentYear' => $this->invoicesYear,
        ];
        $this->response = fn() => view('estates.utility-services::show', $data);
    }
    public function onNotFound(): void
    {
        $this->response = fn() => view("estates.utility-services::show", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => view("estates.utility-services::show", [
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
