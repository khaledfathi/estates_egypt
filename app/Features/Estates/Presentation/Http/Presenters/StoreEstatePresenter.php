<?php

declare(strict_types=1);

namespace App\Features\Estates\Presentation\Http\Presenters;

use App\Features\Estates\Application\Outputs\StoreEstateOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use Closure;
use Illuminate\Support\Facades\Log;

final class StoreEstatePresenter implements StoreEstateOutput
{
    private Closure $response;
    public function onSuccess(EstateEntity $estateEntity): void
    {
        $this->response = fn()=> redirect(route('estates.show', $estateEntity->id));
    }
    public function onFailure(string $error): void
    {
        $this->response = fn()=> back()->withErrors([
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
