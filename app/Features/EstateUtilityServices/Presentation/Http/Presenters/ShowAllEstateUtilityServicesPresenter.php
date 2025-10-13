<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServices\Presentation\Http\Presenters;

use App\Features\EstateUtilityServices\Application\Outputs\ShowAllEstateUtilityServicesOutputs;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowAllEstateUtilityServicesPresenter implements ShowAllEstateUtilityServicesOutputs
{

    private Closure $response;
    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $currentPage = url()->current() ;
        session()->put(SessionKeys::estate_UTILITY_SERVICE_CURRENT_INDEX_PAGE, $currentPage);
        session()->put(SessionKeys::estate_UTILITY_SERVICE_EDIT_PREVIOUS_PAGE, $currentPage);
    }
    /**
     * @inheritDoc
     */
    public function onSuccess(EstateEntity $estateEntity, array $estateUtilityServicesEntities): void
    {
        $data = [
            'estate' => $estateEntity,
            'estateUtilityServices' => $estateUtilityServicesEntities
        ];
        $this->response = fn() => View('estates.utility-services::index', $data);
    }
    public function onNotFound():void{
        $this->response = fn()=> view("estates.utility-services::index", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() =>view("estates.utility-services::index", [
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
