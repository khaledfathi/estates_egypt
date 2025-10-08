<?php
declare (strict_types=1);
namespace App\Features\EstateDocuments\Application\Outputs;

use App\Shared\Domain\Entities\Estate\EstateDocumentEntity;

interface StoreEstateDocumentOutput {
    public function onSuccess (EstateDocumentEntity $estateDocumentEntity):void;
    public function onFailure (string $error):void;
}