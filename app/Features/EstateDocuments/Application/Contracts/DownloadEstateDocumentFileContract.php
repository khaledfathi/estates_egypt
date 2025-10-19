<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Contracts;

use App\Features\EstateDocuments\Application\Outputs\DownloadEstateDocumentFileOutput;

interface DownloadEstateDocumentFileContract
{
    public function execute(int $estaetId, string $fileName, DownloadEstateDocumentFileOutput $presenter);
}
