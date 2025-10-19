<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Contracts;

use App\Features\EstateDocuments\Application\Outputs\CreateEstateDocumentOutput;

interface CreateEstateDocumentContract
{
    public function execute(int $estateId, CreateEstateDocumentOutput $presenter): void;
}
