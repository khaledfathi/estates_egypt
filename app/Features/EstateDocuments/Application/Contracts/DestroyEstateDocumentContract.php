<?php
declare (strict_types=1);
namespace App\Features\EstateDocuments\Application\Contracts;

use App\Features\EstateDocuments\Application\Outputs\DestroyEstateDocumentOutput;

interface DestroyEstateDocumentContract {
    public function destroy(int $estateDocumentId , DestroyEstateDocumentOutput $presenter): void;
}