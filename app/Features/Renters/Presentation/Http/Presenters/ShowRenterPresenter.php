<?php
declare(strict_types= 1);

namespace App\Features\Renters\Presentation\Http\Presenters;

use App\Features\Renters\Application\Outputs\ShowRenterOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use App\Shared\Domain\Entities\Renter\RenterEntity;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowRenterPresenter implements ShowRenterOutput {
    private Closure $response;
    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $previousPage = SessionKeys::RENTER_EDIT_PREVIOUS_PAGE;
        session()->put($previousPage, url()->current());
    }
    public function onSuccess(RenterEntity $renterEntity): void
    {
        $this->response = fn()=> view('renters::show', ['renter' => $renterEntity]);
    }
    public function onNotFount(): void
    {
        $this->response = fn()=> view("renters::show", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(String $error): void
    {
        $this->response = fn()=> view("renters::show", [
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