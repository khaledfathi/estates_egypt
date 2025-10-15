<?php

declare(strict_types=1);

namespace App\Features\OwnerGroups\Presentation\Http\Presenters;

use App\Features\OwnerGroups\Application\Outputs\UpdateOwnerGroupOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

class UpdateOwnerGroupPresenter implements UpdateOwnerGroupOutput
{

    private Closure $response;
    public function onSuccess(bool $status): void
    {
        $this->response = fn() => redirect(route('owner-groups.index'));
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
    public function handle()
    {
        return ($this->response)();
    }
}
