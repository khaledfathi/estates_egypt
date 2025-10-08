<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServices\Presentation\Http\Presenters;

use App\Features\EstateUtilityServices\Application\Outputs\EditEstateUtilityServiceOutput;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceEntity;
use App\Shared\Domain\Enum\Estate\EstateUtilityServiceType;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class EditEstateUtilityServicePresenter implements EditEstateUtilityServiceOutput
{

    private Closure $response;
    public function onSuccess(EstateUtilityServiceEntity $estateUtilityServiceEntity): void
    {
        $data = [
            'estate' => $estateUtilityServiceEntity->estate,
            'estateUtilityService' => $estateUtilityServiceEntity,
            'utilityServiceTypes' => EstateUtilityServiceType::labels(),
        ];
        $this->response = fn() => view("estates.utility-services::edit", $data);
    }
    public function onNotFound(): void
    {
        $this->response = fn() => view("estates.utility-services::edit", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
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
