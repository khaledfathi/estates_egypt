<?php
declare (strict_types=1);
namespace App\Features\SharedWaterInvoices\Presentation\Http\Presenters;

use App\Features\SharedWaterInvoices\Application\Outputs\ShowAllSharedWaterInvoiceOutput;
use App\Shared\Domain\Entities\SharedWaterInvoice\SharedWaterInvoiceEntity;
use Closure;

final class ShowAllSharedWaterInvoicePresenter implements ShowAllSharedWaterInvoiceOutput{
    /**
     * Summary of onSuccess
     * @param array<SharedWaterInvoiceEntity> $sharedWaterInvoicesEntities
     * @return void
     */
    private Closure $response;  
    public function onSuccess (array $sharedWaterInvoicesEntities):void{
        dd('success' , $sharedWaterInvoicesEntities);
    }
    public function onContractNotFound ():void{
        dd('contract not found ');
    }
    public function onFailure (string $error):void{
        dd('failure', $error);
    }
    public function handle (){
        return __CLASS__."::".__FUNCTION__;
    }
}
