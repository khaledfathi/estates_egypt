<?php
declare(strict_types=1);

namespace App\Features\Owners\Presentation\Http\Presenters;

use App\Features\Owners\Application\Outputs\EditOwnerOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use App\Shared\Domain\Entities\Owner\OwnerEntity;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

final class EditOwnerPresenter implements EditOwnerOutput
{
    private Closure $response;
    private string $previousURL;
    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $previousPage = SessionKeys::OWNER_EDIT_PREVIOUS_PAGE;
        $this->previousURL = session($previousPage) ?? route('owners.index');
    }
    public function onSuccess(OwnerEntity $ownerEntity): void
    {
        //this section done because old() mothod in blade dosen't accept array of objects
        $ownerPhones= []; 
        foreach($ownerEntity->phones ?? [] as $phone) {
            $ownerPhones[] =  $phone->phone;
        }
        //
        $this->response = fn()=> view('owners::edit', [
            'owner' => $ownerEntity ,
            'ownerPhones'=>$ownerPhones,
            'previousURL' => $this->previousURL,
        ]);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn()=> view("owners::edit", [
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
        $this->response = fn()=> view("owners::edit", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function handle(): View
    {
        return ($this->response)();
    }
}
