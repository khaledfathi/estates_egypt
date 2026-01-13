<?php
declare(strict_types= 1);
namespace App\Features\Renters\Presentation\Http\Presenters;

use App\Features\Renters\Application\Outputs\StoreRenterOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use App\Shared\Domain\Entities\Renter\RenterEntity;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

final class StoreRenterPresenter implements StoreRenterOutput {

    private Closure $response;
    public function onSuccess (RenterEntity $renterEntity):void {
        $this->response = fn()=> redirect(route('renters.index'))
            ->with('success' ,  Messages::STORE_SUCCESS);
    }
    public function onFailure (string $error):void {
        $this->response = fn()=> back()->withErrors([
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error,  'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );

    }
    public function handle (){

        return ($this->response)();
    }
}