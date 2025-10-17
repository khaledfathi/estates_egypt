<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Contracts;

use App\Features\EstateDocuments\Application\Outputs\EditEstateDocumentOutput;
use App\Features\EstateDocuments\Application\Outputs\UpdateEstateDocumentOutput;
use App\Shared\Application\Contracts\Storage\File;
use App\Shared\Domain\Entities\Estate\EstateDocumentEntity;

interface UpdateEstateDocumentContract
{
    public function execute(EstateDocumentEntity $estateDocumentEntity, ?File $file, UpdateEstateDocumentOutput $presenter): void;
}
