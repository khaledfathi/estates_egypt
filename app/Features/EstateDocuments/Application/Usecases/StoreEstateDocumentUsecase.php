<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Usecases;

use App\Features\EstateDocuments\Application\Contracts\StoreEstateDocumentContract;
use App\Features\EstateDocuments\Application\Outputs\CreateEstateDocumentOutput;
use App\Features\EstateDocuments\Application\Outputs\StoreEstateDocumentOutput;
use App\Shared\Application\Contracts\Storage\File;
use App\Shared\Application\Contracts\Storage\Storage;
use App\Shared\Application\Contracts\Storage\StorageDir;
use App\Shared\Domain\Entities\Estate\EstateDocumentEntity;
use App\Shared\Domain\Repositories\EstateDocumentRepository;
use App\Shared\Domain\Repositories\EstateRepositroy;
use Exception;

final class StoreEstateDocumentUsecase implements StoreEstateDocumentContract
{
    public function __construct(
        private readonly EstateRepositroy $estateRepositroy,
        private readonly EstateDocumentRepository $estateDocumentRepository,
        private readonly Storage $storage,
        private readonly StorageDir $storageDir,
    ) {}
    public function create(int $estateId, CreateEstateDocumentOutput $presenter): void
    {
        try {
            $estateEntity = $this->estateRepositroy->show($estateId);
            $estateEntity
                ? $presenter->onSuccess($estateEntity)
                : $presenter->onNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }

    public function store(EstateDocumentEntity $estateDocumentEntity, ?File $file , StoreEstateDocumentOutput $presenter): void
    {
        $fileName = null;
        $dir = null;
        try {
            //store file 
            if($file){
                $dir = $this->storageDir->estateDocuments($estateDocumentEntity->estateId);
                $fileName = $this->storage->store($dir, $file);
                $estateDocumentEntity->file = $fileName;
            }
            //store estate document data 
            $record = $this->estateDocumentRepository->store($estateDocumentEntity);
            $presenter->onSuccess($record);
        } catch (Exception $e) {
            //remove file if upladed 
            if($dir && $fileName ) $file = $this->storage->remove($dir.$fileName);
            // ---
            //send error  
            $presenter->onFailure($e->getMessage());
        }
    }
}
