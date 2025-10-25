<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Usecases;

use App\Features\EstateDocuments\Application\Contracts\CreateEstateDocumentContract;
use App\Features\EstateDocuments\Application\Outputs\CreateEstateDocumentOutput;
use App\Shared\Domain\Repositories\EstateRepositroy;
use Exception;

final class CreateEstateDocumentUsecase implements CreateEstateDocumentContract
{

    public function __construct(
        private readonly EstateRepositroy $estateRepositroy,
    ) {}
    public function execute(int $estateId, CreateEstateDocumentOutput $presenter): void
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
}
