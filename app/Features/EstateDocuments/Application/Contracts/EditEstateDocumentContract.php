<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Contracts;

use App\Features\EstateDocuments\Application\Outputs\EditEstateDocumentOutput;

interface EditEstateDocumentContract
{
    public function execute(int $estateDocumentId, EditEstateDocumentOutput $presenter): void;
}
