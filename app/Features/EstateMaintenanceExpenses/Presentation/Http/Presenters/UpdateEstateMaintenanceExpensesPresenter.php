<?php
declare (strict_types=1);
namespace App\Features\EstateMaintenanceExpenses\Presentation\Http\Presenters;

use App\Features\EstateMaintenanceExpenses\Application\Outputs\UpdateEstateMaintenanceExpensesOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class UpdateEstateMaintenanceExpensesPresenter implements UpdateEstateMaintenanceExpensesOutput {
    private Closure $response;
    private $lastPage;
    private function handleSession()
    {
        $this->lastPage = session(SessionKeys::ESTATE_MAINTENANCE_EXPENSE_EDIT_PREVIOUS_PAGE);
    }
    public function __construct(
        private readonly int $estateId
    ){
        $this->handleSession();
    }
    public function onSuccess(bool $status):void{
        $this->response = fn()=> redirect($this->lastPage) ; 
    }
    public function onFailure(string $error):void{
        $this->response = fn() =>
            redirect()->back()->withErrors(Messages::INTERNAL_SERVER_ERROR);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }
    public function  handle(){
        return ($this->response)();
    }
}