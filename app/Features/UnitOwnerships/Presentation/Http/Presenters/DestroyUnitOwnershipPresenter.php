<?php

declare(strict_types=1);

namespace App\Features\UnitOwnerships\Presentation\Http\Presenters;

use App\Features\UnitOwnerships\Application\Outputs\DestroyUnitOwnershipOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

class DestroyUnitOwnershipPresenter implements DestroyUnitOwnershipOutput
{
    public Closure $response;
    public function onSuccess(bool $status): void {
        $this->response = fn()=>  back()
            ->with('success', Messages::DESTROY_SUCCESS);
    }
    public function onFailure(string $error): void {
        $this->response = fn() => back()
            ->with('error', Messages::INTERNAL_SERVER_ERROR);
        //log
        Log::channel(LogChannels::ERROR)
            ->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
    }
    public function handle()
    {
        return ($this->response)();
    }
}
