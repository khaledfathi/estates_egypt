<?php

declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Presentation\Http\Presenters;

use App\Features\UnitUtilityServices\Application\Outputs\DestroyUnitUtilityServiceOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class DestroyUnitUtilityServicePresenter implements DestroyUnitUtilityServiceOutput
{
    private Closure $response;
    public function __construct(
        private readonly int $estateId, 
        private readonly int $unitId, 
    ){}
    public function onSuccess(bool $status): void
    {
        $this->response = fn() => redirect(route('estates.units.utility-services.index' ,[
            'estate'=>$this->estateId,
            'unit'=>$this->unitId,
        ]))
        ->with('success', Messages::DESTROY_SUCCESS);
    }
    public function onFailure(string $error): void
    {
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
