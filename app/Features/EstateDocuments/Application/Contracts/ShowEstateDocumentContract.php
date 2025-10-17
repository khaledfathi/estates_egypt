<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Contracts;

use App\Features\EstateDocuments\Application\Outputs\ShowEstateDocumentOutput;
use App\Features\EstateDocuments\Application\Outputs\ShowEstateDocumentsPaginateOutput;

interface ShowEstateDocumentContract
{
    public function execute(int $estateDocumentId, ShowEstateDocumentOutput $presenter): void;
}
