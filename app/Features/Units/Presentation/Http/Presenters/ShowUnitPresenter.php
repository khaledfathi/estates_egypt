<?php

namespace App\Features\Units\Presentation\Http\Presenters;

use App\Features\Units\Application\Ouputs\ShowUnitOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Illuminate\Support\Facades\Log;

final class ShowUnitPresenter implements ShowUnitOutput
{

    private $response;
    public function onSuccess(UnitEntity $unitEntity): void
    {
        $this->response = view('units::show', ['unit' => $unitEntity, 'estate' => $unitEntity->estate]);
    }
    public function onNotFount(): void
    {
        $this->response = view("units::show", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(String $error): void
    {
        $this->response = view("units::show", [
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
        return $this->response;
    }
}
