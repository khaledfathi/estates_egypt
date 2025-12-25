<?php
declare(strict_types=1);
namespace App\Features\RentInvoices\Presentation\Http\Presenters; 

use App\Features\RentInvoices\Application\Outputs\DestroyRentInvoiceOutput;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use Closure;

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
        dd('failure', $error);
    } 
    public function handle(){
        return ($this->response)();
    }
}

