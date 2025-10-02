<?php
declare  (strict_types=1);
namespace App\Features\EstateDocuments\Presentation\Http\Presenters;

use App\Features\EstateDocuments\Application\Outputs\ShowEstateDocumentOutput;
use App\Shared\Domain\Entities\EstateDocument\EstateDocumentEntity;

final class ShowEstateDocumentPresenter  implements ShowEstateDocumentOutput{

    public function onSuccess(EstateDocumentEntity  $estateDocumentEntity):void{
        dd('show estate document success');
    }
    public function onNotFount():void{
        dd('show estate document not found');
    }
    public function onFailure(String $error):void{
        dd('show estate document failure  ');
    }
    public function handle() {
        return __CLASS__."::".__FUNCTION__;
        // return view('estates.documents::show');
     }
}