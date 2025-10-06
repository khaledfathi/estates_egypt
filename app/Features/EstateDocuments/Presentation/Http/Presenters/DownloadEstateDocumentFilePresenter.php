<?php
declare (strict_types=1);

namespace App\Features\EstateDocuments\Presentation\Http\Presenters;

use App\Features\EstateDocuments\Application\Outputs\DownloadEstateDocumentFileOutput;
use Closure;

final class DownloadEstateDocumentFilePresenter implements DownloadEstateDocumentFileOutput{

    private Closure $response ; 
    public function onSuccess(string $filePath):void{
        $this->response = fn()=> response()->download($filePath);
    }
    public function onFailure():void{
        $this->response = fn() => abort(404);
    }
    public function handle(){
        return  ($this->response)();
    }
}