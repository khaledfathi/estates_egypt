<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Contracts;

use App\Features\EstateDocuments\Application\Outputs\ShowEstateDocumentsPaginationOutput;

interface ShowEstateDocumentsPaginationContract
{
    public function execute(ShowEstateDocumentsPaginationOutput $presenter, int $estateId, int $perPage = 5): void;
}
