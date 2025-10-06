<?php
declare (strict_types=1);
namespace App\Features\EstateDocuments\Application\Outputs;

interface UpdateEstateDocumentOutput {
   public function onSuccess(bool $status ):void; 
   public function onFailure(string $error):void; 
}