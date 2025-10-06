<?php
declare (strict_types=1);

namespace App\Features\EstateDocuments\Application\Outputs;
interface DownloadEstateDocumentFileOutput {
    public function onSuccess(string $filePath):void;
    public function onFailure():void;
}