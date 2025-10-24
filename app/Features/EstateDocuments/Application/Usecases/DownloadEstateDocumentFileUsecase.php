<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Usecases;

use App\Features\EstateDocuments\Application\Contracts\DownloadEstateDocumentFileContract;
use App\Features\EstateDocuments\Application\Outputs\DownloadEstateDocumentFileOutput;
use App\Shared\Application\Contracts\Storage\StorageDir;
use Exception;

final class DownloadEstateDocumentFileUsecase implements DownloadEstateDocumentFileContract
{
    public function __construct(
        private readonly StorageDir $storageDir,
    ) {}
    public function execute(int $estaetId, string $fileName, DownloadEstateDocumentFileOutput $presenter)
    {
        try {
            $file = $this->storageDir->privatePath()->estateDocuments($estaetId) . $fileName;
            file_exists($file)
                ?  $presenter->onSuccess($file)
                : $presenter->onNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
