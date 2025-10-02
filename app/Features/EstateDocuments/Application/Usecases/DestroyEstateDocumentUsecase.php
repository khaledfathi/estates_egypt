<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Usecases;

use App\Features\EstateDocuments\Application\Contracts\DestroyEstateDocumentContract;
use App\Features\EstateDocuments\Application\Outputs\DestroyEstateDocumentOutput;
use App\Shared\Application\Contracts\Storage\Storage;
use App\Shared\Application\Contracts\Storage\StorageDir;
use App\Shared\Domain\Repositories\EstateDocumentRepository;

final class DestroyEstateDocumentUsecase implements DestroyEstateDocumentContract
{

    public function __construct(
        private readonly EstateDocumentRepository $estateDocumentRepository,
        private readonly StorageDir $storageDir,
        private readonly Storage $storage
    ){ }
    public function destroy(int $estateDocumentId,  DestroyEstateDocumentOutput $presenter): void {
        try {
            //get record before delete 
            $estateDocumentEntity = $this->estateDocumentRepository->show($estateDocumentId);
            //delete record
            $destroyEstateDocumentStatus= $this->estateDocumentRepository->destroy($estateDocumentId) ;
            //remove file releated to this estate document 
            if($destroyEstateDocumentStatus){
                $this->storage->remove($this->storageDir->estateDocuments($estateDocumentEntity->estateId).$estateDocumentEntity->file);
            }
            //
            $presenter->onSuccess($destroyEstateDocumentStatus);
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }

    }
}
