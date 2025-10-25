<?php
declare(strict_types=1);
namespace App\Features\UnitUtilityServices\Presentation\Http\Presenters;

use App\Features\UnitUtilityServices\Application\Outputs\EditUnitUtilityServiceOutput;
use App\Shared\Domain\Entities\Unit\UnitUtilityServiceEntity;
use App\Shared\Domain\Enum\Unit\UnitUtilityServiceType;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class EditUnitUtilityServicePresenter implements EditUnitUtilityServiceOutput{
    private Closure $response;
   private string $previousURL;
   public function __construct(
    private readonly int $estateId,
    private readonly int $unitId,
   )
   {
      $this->handleSession();
   }
   private function handleSession()
   {
      $previousPage = SessionKeys::UNIT_UTILITY_SERVICE_EDIT_PREVIOUS_PAGE;
      $this->previousURL = session($previousPage) 
         ?? route('estates.units.utility-services.index', ['estate' => $this->estateId, 'unit' => $this->unitId]);
   }
    public function onSuccess(UnitUtilityServiceEntity $unitUtilityServiceEntity):void{
        $data =[
            'estate' => $unitUtilityServiceEntity->estate,
            'unit' => $unitUtilityServiceEntity->unit,
            'unitUtilityService' => $unitUtilityServiceEntity,
            'utilityServiceTypes' => UnitUtilityServiceType::labels(),
            'previousURL' => $this->previousURL,
        ];
        $this->response = fn() => view("units.utility-services::edit", $data);
    }
    public function onNotFound():void{
        $this->response = fn() => view("units.utility-services::edit", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error):void{
        $this->response = fn() => back()->withErrors([
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error,  'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }
    public function handle(){
        return ($this->response)();
    }
}