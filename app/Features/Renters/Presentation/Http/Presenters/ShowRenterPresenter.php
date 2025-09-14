<?php
declare(strict_types= 1);

namespace App\Features\Renters\Presentation\Http\Presenters;

use App\Features\Renters\Application\Outputs\ShowRenterOutput;
use App\Shared\Contstants\LogChannels;
use App\Shared\Contstants\Messages;
use App\Shared\Contstants\SessionKeys;
use App\Shared\Domain\Entities\Renter\RenterEntity;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

final class ShowRenterPresenter implements ShowRenterOutput {
    private View $response;
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
        $this->response = view('renters.show', ['renter' => $renterEntity]);
    }
    public function onNotFount(): void
    {
        $this->response = view("renters.show", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(String $error): void
    {
        $this->response = view("renters.show", [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error,  'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }

    public function handle(): View
    {
        return $this->response;
    }
}