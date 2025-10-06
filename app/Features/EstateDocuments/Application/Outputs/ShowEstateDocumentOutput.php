<?php
declare (strict_types=1);

namespace App\Features\EstateDocuments\Application\Outputs;

use App\Shared\Domain\Entities\EstateDocument\EstateDocumentEntity;

interface ShowEstateDocumentOutput {
    public function onSuccess(EstateDocumentEntity $estateDocumentEntity):void;
    public function onNotFount():void;
    public function onFailure(String $error):void;
}