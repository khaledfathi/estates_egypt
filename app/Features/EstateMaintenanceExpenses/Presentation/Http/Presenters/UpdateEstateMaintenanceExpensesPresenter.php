<?php
declare (strict_types=1);
namespace App\Features\EstateMaintenanceExpenses\Presentation\Http\Presenters;

use App\Features\EstateMaintenanceExpenses\Application\Outputs\UpdateEstateMaintenanceExpensesOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class UpdateEstateMaintenanceExpensesPresenter implements UpdateEstateMaintenanceExpensesOutput {
    private Closure $response;
    public function __construct(
        private readonly int $estateId
    ){}
    public function onSuccess(bool $status):void{
        $this->response = fn()=> redirect(route('estates-maintenance-expenses.index' , ['estate_id' => $this->estateId] )) ; 
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