<?php
declare (strict_types=1);
namespace App\Features\EstateDocuments\Presentation\Http\Presenters;

use App\Features\EstateDocuments\Application\Outputs\EditEstateDocumentOutput;
use App\Shared\Domain\Entities\Estate\EstateDocumentEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

class EditEstateDocumentPresenter implements EditEstateDocumentOutput {

   private Closure $response;
   private string $previousURL;
   private int $estaetId ; 
   private int $estateDocumentId; 
   private function handleSession()
   {
      $previousPage = SessionKeys::ESTATE_DOCUMENT_EDIT_PREVIOUS_PAGE;
      $this->previousURL = session($previousPage) 
         ?? route('estates.documents..index');
   }
   public function onSuccess(EstateDocumentEntity $estateDocumentEntity):void{
      $this->response = fn() => view ("estates.documents::edit",[
         'estate' => $estateDocumentEntity->estate,
         'estateDocument' => $estateDocumentEntity,
         'previousURL' => $this->previousURL
      ]);
      $this->estaetId = $estateDocumentEntity->estateId;
      $this->estateDocumentId= $estateDocumentEntity->id;
      $this->handleSession();
   }
   public function onNotFound():void{
      $this->response = fn() => view("estates.documents::edit", [
         'found' => false,
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
      return ($this->response) ();
   }
}