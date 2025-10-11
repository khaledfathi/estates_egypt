<?php
declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Presentation\Http\Presenters;

use App\Features\UnitUtilityServices\Application\Outputs\CreateUnitUtilityServiceOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\Enum\Unit\UnitUtilityServiceType;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class CreateUnitUtilityServicePresenter implements CreateUnitUtilityServiceOutput {

    private Closure $response;
    public function onSuccess (UnitEntity $unitEntity):void{
        $data =[
            'estate'=> $unitEntity->estate,
            'unit' => $unitEntity,
            'utilityServiceTypes' => UnitUtilityServiceType::labels(),
        ];
        $this->response = fn () => view('units.utility-services::create', $data);
    }
    public function onNotFound():void{
        $this->response = fn()=>view("unit.utility-services::index", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error):void{
        $this->response = fn() => view('unit.utility-services::index', [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)
            ->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
    }
    public function handle (){
        return ($this->response)();
    }
}