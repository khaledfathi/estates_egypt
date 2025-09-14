<?php
declare(strict_types=1);

namespace App\Features\Owners\Presentation\Http\Presenters;

use App\Features\Owners\Application\Outputs\StoreOwnerOutput;
use App\Shared\Contstants\LogChannels;
use App\Shared\Contstants\Messages;
use App\Shared\Domain\Entities\Owner\OwnerEntity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

final class StoreOwnerPresenter implements StoreOwnerOutput
{
    private RedirectResponse $response;
    public function onSuccess(OwnerEntity $ownerEntity): void
    {
        $this->response = redirect(route('owners.index'))
            ->with('success' ,  Messages::STORE_SUCCESS);
    }
    public function onFailure(string $error): void
    {
        $this->response = back()->withErrors([
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error,  'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }
    public function handle(): RedirectResponse
    {
        return $this->response;
    }
}
