<?php
declare(strict_types=1);

namespace App\Features\Owners\Presentation\Http\Presenters;

use App\Features\Owners\Application\Outputs\DestroyOwnerOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class DestroyOwnerPresenter implements DestroyOwnerOutput
{
    private Closure $response;
    public function onSuccess(bool $status): void
    {
        $this->response = function () {
            return redirect(route('owners.index'))->with('success', Messages::DESTROY_SUCCESS);
        };
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => back()->with('error', Messages::INTERNAL_SERVER_ERROR);
        //log
        Log::channel(LogChannels::ERROR)->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
    }
    public function handle()
    {
        return ($this->response)();
    }
}
