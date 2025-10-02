<?php
declare (strict_type=1);

namespace App\Features\EstateDocuments\Application\Outputs;

interface DestroyEstateDocumentOutput{
    public function onSuccess(bool $status): void;
    public function onFailure($error):void;
}