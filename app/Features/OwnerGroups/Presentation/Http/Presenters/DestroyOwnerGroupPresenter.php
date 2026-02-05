<?php
declare (strict_types=1);
namespace App\Features\OwnerGroups\Presentation\Http\Presenters;

use App\Features\OwnerGroups\Application\Outputs\DestroyOwnerGroupOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class DestroyOwnerGroupPresenter implements DestroyOwnerGroupOutput {
    private Closure $response;
    private $lastIndexPage;
    public function __construct()
    {
        $this->lastIndexPage = session(SessionKeys::OWNER_GROUP_CURRENT_INDEX_PAGE) ?? url()->previous();
    }
    public function onSuccess (bool $status):void{
        $this->response = fn() =>
         redirect($this->lastIndexPage)
         ->with('success', Messages::STORE_SUCCESS);
    }
    public function onFailure(string $error):void{
        $this->response = fn() => redirect(route('owner-groups.index'))->with('error', Messages::INTERNAL_SERVER_ERROR);
        //log
        Log::channel(LogChannels::ERROR)->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
    }
    public function handle(){
        return ($this->response)();
    }
}