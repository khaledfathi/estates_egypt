<?php
declare (strict_types=1);
namespace App\Features\UnitUtilityServices\Presentation\Http\Presenters;

use App\Features\UnitUtilityServices\Application\Outputs\ShowUnitUtilityServiceOutput;
use App\Shared\Domain\Entities\Unit\UnitUtilityServiceEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowUnitUtilityServicePresenter implements ShowUnitUtilityServiceOutput {
    private Closure $response;
    public function onSuccess(UnitUtilityServiceEntity $unitUtilityServiceEntity):void{
        $data = [
            'estate'=>$unitUtilityServiceEntity->estate,
            'unit'=>$unitUtilityServiceEntity->unit,
            'unitUtilityService'=>$unitUtilityServiceEntity,
        ];
        $this->response = fn () => view("units.utility-services::show", $data);
    }
    public function onNotFound():void{
        $this->response = fn () => view("units.utility-services::show", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error):void{
        $this->response = fn()=> view("units.utility-services::show", [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error,  'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }

    public function handle() {
        return ($this->response)();
    }
}