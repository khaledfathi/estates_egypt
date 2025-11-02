<?php

declare(strict_types=1);

namespace App\Features\UnitContracts\Presentation\Http\Presenters;

use App\Features\UnitContracts\Application\Ouputs\EditUnitContractOutput;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;
use App\Shared\Domain\Enum\Unit\UnitContractType;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Infrastructure\Utilities\CarbonDateUtility;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class EditUnitContractPresenter implements EditUnitContractOutput
{
    private Closure $response;
   private string $previousURL;
   public function __construct(
        private readonly int $estateId ,
        private readonly int $unitId,
   ){
        $this->handleSession();
   }
   private function handleSession()
   {
      $previousPage = SessionKeys::UNIT_CONTRACT_EDIT_PREVIOUS_PAGE;
      $this->previousURL = session($previousPage) 
         ?? route('estates.units.contracts.index', ['estate' => $this->estateId, 'unit' =>$this->unitId]);
   }
    public function onSuccess(UnitContractEntity $unitContractEntity, array $renterEntities): void
    {
        $data = [
            'estate' => $unitContractEntity->unit->estate,
            'unit' => $unitContractEntity->unit,
            'unitContract' => $unitContractEntity,
            'renters' => $renterEntities,
            'unitContractTypes' => UnitContractType::labels(),
            'currentDateValue'=> CarbonDateUtility::now()->toDateString(),
            'previousURL' => $this->previousURL
        ];
        $this->response = fn() => view('unit-contracts::edit', $data);
    }
    public function onNotfound(): void
    {
        $this->response = fn() => view("unit-contracts::show", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => view("unit-contracts::show", [
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
