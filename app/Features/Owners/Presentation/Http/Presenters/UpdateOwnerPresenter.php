<?php
declare(strict_types=1);

namespace App\Features\Owners\Presentation\Http\Presenters;

use App\Features\Owners\Application\Outputs\UpdateOwnerOutput;
use App\Shared\Contstants\LogChannels;
use App\Shared\Contstants\Messages;
use App\Shared\Contstants\SessionKeys;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;


final class UpdateOwnerPresenter implements UpdateOwnerOutput
{
    private Closure $response;
    private $lastPage;
    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $this->lastPage = session(SessionKeys::OWNER_EDIT_PREVIOUS_PAGE);
    }
    public function onSuccess(bool $status): void
    {
        $this->response = fn() =>
            redirect($this->lastPage)->with('success', Messages::UPDATE_SUCCESS);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() =>
            redirect()->back()->withErrors(Messages::INTERNAL_SERVER_ERROR);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }
    public function handle(): RedirectResponse
    {
        return ($this->response)();
    }
}
