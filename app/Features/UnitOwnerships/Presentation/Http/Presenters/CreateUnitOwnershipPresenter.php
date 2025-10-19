<?php
declare(strict_types=1);
namespace App\Features\UnitOwnerships\Presentation\Http\Presenters;

use App\Features\UnitOwnerships\Application\Outputs\CreateUnitOwnershipOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

class CreateUnitOwnershipPresenter implements CreateUnitOwnershipOutput {

    public Closure $response ;
    public function onSuccess (UnitEntity $unitEntity , array $ownerGroupEntities) :void
    {
        $data =[
            'estate'=> $unitEntity->estate,
            'unit'=>$unitEntity,
            'owners'=>$unitEntity->owners,
            'ownerGroups' =>$ownerGroupEntities,
        ];
        $this->response = fn()=> view('units.ownerships::create' , $data) ;
    }
    public function onUnitNotFound(): void{
      $this->response = fn() => view('units.ownerships::create', [
         'error' => Messages::DATA_NOT_FOUND,
      ]);
    }
    public function onFailure(string $error) :void
    {
        $this->response = fn ()=> back()->withErrors([
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