<?php
declare (strict_types=1); 
namespace App\Features\EstateUtilityServiceInvoices\Presentation\Http\Presenters; 

use App\Features\EstateUtilityServiceInvoices\Application\Outputs\DownloadEstateUtilityServiceInvoiceFileOutput;
use Closure;

final class ViewEstateUtilityServiceInvoiceFilePresenter implements DownloadEstateUtilityServiceInvoiceFileOutput
{
    private Closure $response ; 
    public function onSuccess(string $filePath):void{
        $this->response = fn()=> response()->file($filePath);
    }
    public function onNotFound():void{
        $this->response = fn() => abort(404);
    }
    public function onFailure(string $error):void{
        $this->response = fn() => abort(404);
    }
    public function handle(){
        return  ($this->response)();
    }
}