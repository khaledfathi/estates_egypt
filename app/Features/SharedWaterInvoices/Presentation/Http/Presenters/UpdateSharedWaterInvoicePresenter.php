<?php
declare (strict_types=1);
namespace App\Features\SharedWaterInvoices\Presentation\Http\Presenters;

use App\Features\SharedWaterInvoices\Application\Outputs\UpdateSharedWaterInvoiceOutput;
use Closure;

final class UpdateSharedWaterInvoicePresenter implements UpdateSharedWaterInvoiceOutput {
    private Closure $response; 
    public function onSuccess (bool $status):void {
        dd('success' , $status);
    }
    public function onFailure (string $error):void {
        dd('failure' , $error);
    }
    public function handle(){
        return __CLASS__."::".__FUNCTION__;
    }
}
