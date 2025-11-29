<?php

declare(strict_types=1);

namespace App\Features\Estates\Presentation\Http\Presenters;

use App\Features\Estates\Application\Outputs\ShowEstateOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowEstatePresenter implements ShowEstateOutput
{

    private Closure $response;
    public function onSuccess(EstateEntity $estateEntity): void
    {
        $this->response = fn ()=> view('estates::show', [
            'estate' => $estateEntity,
        ]);
    }
    public function onNotFound(): void
    {
        $this->response = fn()=> view("estates::show", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error): void {
        $this->response = fn()=> view("estates::show", [
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
