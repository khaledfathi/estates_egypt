<?php
declare(strict_types=1);

namespace App\Features\Owners\Presentation\Http\Presenters;

use App\Features\Owners\Application\Outputs\EditOwnerOutput;
use App\Shared\Contstants\LogChannels;
use App\Shared\Contstants\Messages;
use App\Shared\Contstants\SessionKeys;
use App\Shared\Domain\Entities\OwnerEntity;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

final class EditOwnerPresenter implements EditOwnerOutput
{
    private View $response;
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
        $this->response = view('owners.edit', ['owner' => $ownerEntity]);
    }
    public function onFailure(string $error): void
    {
        $this->response = view("owners.edit", [
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
        $this->response = view("owners.edit", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function handle(): View
    {
        return $this->response->with('previousURL', $this->previousURL);
    }
}
