<?php
declare(strict_types=1);
namespace App\Features\OwnerGroups\Presentation\Http\Presenters;

use App\Features\OwnerGroups\Application\Outputs\EditOwnerGroupsOutput;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class EditOwnerGroupPresenter implements EditOwnerGroupsOutput {
    private Closure $response;
    public function onSuccess (OwnerGroupEntity $ownerGroupEntity):void{
        $this->response= fn()=> view('owner-groups::edit',  ['ownerGroup'=>$ownerGroupEntity]);
    }
    public function onNotFound():void{
        $this->response =fn()=> view("owner-groups::edit", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error):void{
        $this->response = fn()=> view("owners::edit", [
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