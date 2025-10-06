<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Usecases;

use App\Features\EstateDocuments\Application\Contracts\UpdateEstateDocumentContract;
use App\Features\EstateDocuments\Application\Outputs\EditEstateDocumentOutput;
use App\Features\EstateDocuments\Application\Outputs\UpdateEstateDocumentOutput;
use App\Shared\Application\Contracts\Storage\File;
use App\Shared\Application\Contracts\Storage\Storage;
use App\Shared\Application\Contracts\Storage\StorageDir;
use App\Shared\Domain\Entities\EstateDocument\EstateDocumentEntity;
use App\Shared\Domain\Repositories\EstateDocumentRepository;
use Exception;

final class UpdateEstateDocumentUsecase implements UpdateEstateDocumentContract
{

    public function __construct(
        private readonly Storage $storage,
        private readonly StorageDir $storageDir,
        private readonly EstateDocumentRepository $estateDocumentRepository,
    ) {}
    public function edit(int $estateDocumentId, EditEstateDocumentOutput $presenter): void
    {
        try {
            $estateDocumentEntity = $this->estateDocumentRepository->show($estateDocumentId);
            $estateDocumentEntity
                ? $presenter->onSuccess($estateDocumentEntity)
                : $presenter->onNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
    public function update(EstateDocumentEntity $estateDocumentEntity, ?File $file, UpdateEstateDocumentOutput $presenter): void
    {
        try {
            //is file updated 
            if ($file) {
                $oldFile = $this->estateDocumentRepository->show($estateDocumentEntity->id)->file;
                $storageDir = $this->storageDir->estateDocuments($estateDocumentEntity->estateId);
                //remove old file
                $this->storage->remove($storageDir.$oldFile);
                //save new file
                $estateDocumentEntity->file = $this->storage->store($storageDir, $file);
            }
            //update 
            $status = $this->estateDocumentRepository->update($estateDocumentEntity);
            $presenter->onSuccess($status);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
