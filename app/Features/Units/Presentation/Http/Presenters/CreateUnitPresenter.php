<?php

namespace App\Features\Units\Presentation\Http\Presenters;

use App\Features\Units\Application\DTOs\UnitFormDTO;
use App\Features\Units\Application\Ouputs\CreateUnitOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class CreateUnitPresenter implements CreateUnitOutput
{

    private Closure $response;
    public function onSuccess(UnitFormDTO $unitFormData)
    {
        $this->response = fn() => view('units::create', [
            'estate' => $unitFormData->estateEntity,
            'unitTypes' => $unitFormData->unitTypes,
            'unitOwnershipTypes' => $unitFormData->unitOwnershipTypes,
            'unitIsEmptyLabels' => $unitFormData->unitIsEmptyLabels
        ]);
    }
    public function onFailure(string $error) {
        $this->response = fn ()=> back()->withErrors([
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
