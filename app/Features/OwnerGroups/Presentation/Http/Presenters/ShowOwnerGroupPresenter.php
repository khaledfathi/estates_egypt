<?php

declare(strict_types=1);

namespace App\Features\OwnerGroups\Presentation\Http\Presenters;

use App\Features\OwnerGroups\Application\Outputs\ShowOwnerGroupOutput;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowOwnerGroupPresenter implements ShowOwnerGroupOutput
{
    private Closure  $response;
    public function __construct(
        private readonly int $ownerGroupId,
    ){
        $this->handleSession();
    }
    private function handleSession()
    {
        $previousPage = SessionKeys::OWNER_GROUP_EDIT_PREVIOUS_PAGE;
        session()->put($previousPage, url()->current());
    }
    public function onSuccess(OwnerGroupEntity $ownerGroupEntity): void
    {
        $this->response = fn() => 
            view("owner-groups::show", ['ownerGroup'=> $ownerGroupEntity , 'ownerGroupId' => $this->ownerGroupId]);
    }
    public function onNotFound(): void
    {
        $this->response = fn() => view("owner-groups::show", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => view("owner-groups::show", [
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
