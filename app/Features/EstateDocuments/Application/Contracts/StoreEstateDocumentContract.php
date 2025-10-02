<?php
declare (strict_types=1);
namespace App\Features\EstateDocuments\Application\Contracts;

use App\Features\EstateDocuments\Application\Outputs\CreateEstateDocumentOutput;
use App\Features\EstateDocuments\Application\Outputs\StoreEstateDocumentOutput;
use App\Shared\Application\Contracts\Storage\File;
use App\Shared\Domain\Entities\EstateDocument\EstateDocumentEntity;

interface StoreEstateDocumentContract {
    public function create(int $estateId, CreateEstateDocumentOutput $presenter):void ;
    public function store(EstateDocumentEntity $estateDocumentEntity, File $file , StoreEstateDocumentOutput $presenter): void;
}