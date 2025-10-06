<?php

declare(strict_types=1);

namespace App\Features\Units\Presentation\Http\Presenters;

use App\Features\Units\Application\DTOs\UnitFormDTO;
use App\Features\Units\Application\Ouputs\EditUnitOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class EditUnitPresenter implements EditUnitOutput
{
   private Closure $response;
   private string $previousURL;
   public function __construct()
   {
      $this->handleSession();
   }
   private function handleSession()
   {
      $previousPage = SessionKeys::UNIT_EDIT_PREVIOUS_PAGE;
      $this->previousURL = session($previousPage) 
         ?? route('units.index');
   }
   public function onSuccess(UnitFormDTO $unitFormData, UnitEntity $unitEntity): void
   {
      $this->response = fn() => view('units::edit', [
         'estate' => $unitFormData->estateEntity,
         'unit' => $unitEntity,
         'unitTypes' => $unitFormData->unitTypes,
         'unitOwnershipTypes' => $unitFormData->unitOwnershipTypes,
         'unitIsEmptyLabels' => $unitFormData->unitIsEmptyLabels,
         'found' => true,
      ]);
   }
   public function onNotFound(): void
   {
      $this->response = fn() => view("units::edit", [
         'found' => false,
         'error' => Messages::DATA_NOT_FOUND,
      ]);
   }
   public function onFailure($error): void
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
      // return ($this->response)();
      return ($this->response)()->with(['previousURL' => $this->previousURL]);
   }
}
