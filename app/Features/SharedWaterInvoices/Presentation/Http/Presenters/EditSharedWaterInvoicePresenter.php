<?php
declare (strict_types=1);
namespace App\Features\SharedWaterInvoices\Presentation\Http\Presenters;

use App\Features\SharedWaterInvoices\Application\Outputs\EditSharedWaterInvoiceOutput;
use App\Shared\Domain\Entities\SharedWaterInvoice\SharedWaterInvoiceEntity;
use Closure;

final class EditSharedWaterInvoicePresenter implements EditSharedWaterInvoiceOutput {
    private Closure $response;
    public function onSuccess ( SharedWaterInvoiceEntity $sharedWaterInvoiceEntity):void{
        // dd('success'  , $sharedWaterInvoiceEntity);
        $this->response = fn()=> view('shared-water-invoices::edit');
    }
    public function onNotFound ():void{
        dd('success');
    }
    public function onFailure ( string $error ):void{
        dd('success' , $error);
    }
    public function handle() { 
        return ($this->response)();
    }
}
