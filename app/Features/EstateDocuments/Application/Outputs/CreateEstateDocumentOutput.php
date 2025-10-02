<?php
declare (strict_types=1);
namespace App\Features\EstateDocuments\Application\Outputs;

use App\Shared\Domain\Entities\Estate\EstateEntity;

interface CreateEstateDocumentOutput {
    public function onSuccess (EstateEntity $estateEntity);
    public function onNotFound ();
    public function onFailure (string $error);

}