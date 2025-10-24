<?php
declare (strict_types= 1);

namespace App\Features\Units\Presentation\Http\Presenters;

use App\Features\Units\Application\Ouputs\UpdateUnitOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class UpdateUnitPresenter implements UpdateUnitOutput {
    private Closure $response;
    private $lastPage;
    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $this->lastPage = session(SessionKeys::UNIT_EDIT_PREVIOUS_PAGE);
    }
    public function onSuccess(bool $status , UnitEntity $unitEntity): void{
        $this->response =  fn() =>   redirect($this->lastPage)
        ->with('success' , Messages::UPDATE_SUCCESS);
    }
    public function onFailure($error):void{
        $this->response = fn() =>
            redirect()->back()->withErrors(Messages::INTERNAL_SERVER_ERROR);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }
    public  function handle (){
        return ($this->response)();
    }
}
 