<?php
declare (strict_types=1);
namespace App\Features\EstateDocuments\Application\Contracts;

use App\Features\EstateDocuments\Application\Outputs\EditEstateDocumentOutput;
use App\Features\EstateDocuments\Application\Outputs\UpdateEstateDocumentOutput;
use App\Shared\Application\Contracts\Storage\File;
use App\Shared\Domain\Entities\EstateDocument\EstateDocumentEntity;

interface UpdateEstateDocumentContract{
    public function edit(int $estateDocumentId , EditEstateDocumentOutput $presenter):void;
    public function update(EstateDocumentEntity $estateDocumentEntity ,?File $file  , UpdateEstateDocumentOutput $presenter):void;
}