<?php

declare(strict_types=1);

namespace App\Features\Owners\Presentation\API\Presenters;

use App\Features\Owners\Application\Outputs\CreateOwnerOutput;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class CreateOwnerPresenter implements CreateOwnerOutput
{

    private Closure $response;
    /**
     * @inheritDoc
     */
    public function onSuccess(array $ownerGroups): void
    {
        $this->response = fn() => view( 'owners::create',
            [ 'ownerGroups' => $ownerGroups ]
        );
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => back()->withErrors([
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
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
