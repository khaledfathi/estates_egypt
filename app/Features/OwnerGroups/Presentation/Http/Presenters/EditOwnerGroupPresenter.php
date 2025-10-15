<?php
declare(strict_types=1);
namespace App\Features\OwnerGroups\Presentation\Http\Presenters;

use App\Features\OwnerGroups\Application\Outputs\EditOwnerGroupsOutput;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use Closure;

final class EditOwnerGroupPresenter implements EditOwnerGroupsOutput {
    private Closure $response;
    public function onSuccess (OwnerGroupEntity $ownerGroupEntity):void{
        $this->response= fn()=> view('owner-groups::edit',  ['ownerGroup'=>$ownerGroupEntity]);
    }
    public function onNotFound():void{
        dd('not found');
    }
    public function onFailure(string $error):void{
        dd('failure' , $error);
    }
    public function handle(){
        return ($this->response)();
    }
}