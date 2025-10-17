<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Contracts;

use App\Features\EstateDocuments\Application\Outputs\ShowEstateDocumentsPaginateOutput;

interface ShowPaginateEstateDocumentContract
{
    public function execute(ShowEstateDocumentsPaginateOutput $presenter, int $estateId, int $perPage = 5): void;
}
