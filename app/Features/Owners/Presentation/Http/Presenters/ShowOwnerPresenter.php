<?php
declare(strict_types=1);

namespace App\Features\Owners\Presentation\Http\Presenters;

use App\Features\Owners\Application\Outputs\ShowOwnerOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use App\Shared\Domain\Entities\Owner\OwnerEntity;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

final class ShowOwnerPresenter implements ShowOwnerOutput
{
    private Closure $response;
    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $previousPage = SessionKeys::OWNER_EDIT_PREVIOUS_PAGE;
        session()->put($previousPage, url()->current());
    }
    public function onSuccess(OwnerEntity $ownerEntity): void
    {
        $this->response = fn()=> view('owners::show', ['owner' => $ownerEntity]);
    }
    public function onNotFound(): void
    {
        $this->response = fn()=> view("owners::show", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(String $error): void
    {
        $this->response = fn()=> view("owners::show", [
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
        return ($this->response)();
    }
}
