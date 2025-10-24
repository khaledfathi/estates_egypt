<?php
declare(strict_types=1);

namespace App\Features\OwnerGroups\Presentation\Http\Presenters;

use App\Features\OwnerGroups\Application\Outputs\StoreOwnerGroupOutput;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class StoreOwnerGroupPresenter implements StoreOwnerGroupOutput
{
    private Closure $response;
    public function onSuccess(OwnerGroupEntity $ownerGroupEntity): void
    {
        $this->response = fn() => redirect(route('owner-groups.index'))
            ->with('success', Messages::STORE_SUCCESS);
    }
    public function onFailure($error): void
    {
        $this->response = fn() => back()
            ->withInput()
            ->with('error', Messages::INTERNAL_SERVER_ERROR);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error,  'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }
    public function handle()
    {
        return ($this->response)();
    }
}
