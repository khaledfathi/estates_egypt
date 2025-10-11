<?php

declare(strict_types=1);

namespace App\Features\Renters\Presentation\Http\Presenters;

use App\Features\Renters\Application\Outputs\EditRenterOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use App\Shared\Domain\Entities\Renter\RenterEntity;
use App\Shared\Domain\Enum\Renter\RenterIdentityType;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

final class EditRenterPresenter implements EditRenterOutput
{

    private View $response;
    private string $previousURL;
    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $previousPage = SessionKeys::RENTER_EDIT_PREVIOUS_PAGE;
        $this->previousURL = session($previousPage) ?? route('renters.index');
    }
    public function onSuccess(RenterEntity $renterEntity): void
    {
        //this section done because old() mothod in blade dosen't accept array of objects
        $renterPhones = [];
        foreach ($renterEntity->phones ?? [] as $phone) {
            $renterPhones[] =  $phone->phone;
        }
        //
        $this->response = view('renters::edit', [
            'renter' => $renterEntity,
            'renterPhones' => $renterPhones,
            'renterIdentityTypes' => RenterIdentityType::labels(),
        ]);
    }
    public function onFailure(string $error): void
    {
        $this->response = view("renters::edit", [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error,  'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }
    public function onNotFound(): void
    {
        $this->response = view("renters::edit", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }

    public function handle()
    {
        return $this->response->with('previousURL', $this->previousURL);
    }
}
