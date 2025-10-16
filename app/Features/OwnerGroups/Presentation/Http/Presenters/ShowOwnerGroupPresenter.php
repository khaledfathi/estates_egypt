<?php

declare(strict_types=1);

namespace App\Features\OwnerGroups\Presentation\Http\Presenters;

use App\Features\OwnerGroups\Application\Outputs\ShowOwnerGroupOutput;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

class ShowOwnerGroupPresenter implements ShowOwnerGroupOutput
{
    private Closure  $response;
    public function __construct(
        private readonly int $ownerGroupId,
    ){}
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
