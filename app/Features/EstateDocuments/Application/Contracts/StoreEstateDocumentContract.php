<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Contracts;

use App\Features\EstateDocuments\Application\Outputs\StoreEstateDocumentOutput;
use App\Shared\Application\Contracts\Storage\File;
use App\Shared\Domain\Entities\Estate\EstateDocumentEntity;

interface StoreEstateDocumentContract
{
    public function execute(EstateDocumentEntity $estateDocumentEntity, File $file, StoreEstateDocumentOutput $presenter): void;
}
