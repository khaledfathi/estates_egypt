<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Presentation\Http\Presenters; 

use App\Features\RentInvoices\Application\Outputs\DestroyRentInvoiceOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class DestroyRentInvoicePresenter implements DestroyRentInvoiceOutput{
    private Closure $response;
    private $lastIndexPageUrl ; 
    public function __construct() { 
        $this->lastIndexPageUrl = session(SessionKeys::RENT_INVOICE_CURRENT_INDEX_PAGE);
    }
    public function onSeuccess(bool $status):void{
        $this->response = fn ()=> redirect($this->lastIndexPageUrl);
    } 
    public function onFailure(string $error):void{
        $this->response = fn() => back()
            ->with('error', Messages::INTERNAL_SERVER_ERROR);
        //log
        Log::channel(LogChannels::ERROR)
            ->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
    } 
    public function handle(){
        return ($this->response)();
    }
}

