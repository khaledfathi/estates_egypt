<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Usecases;

use App\Features\EstateDocuments\Application\Contracts\EditEstateDocumentContract;
use App\Features\EstateDocuments\Application\Outputs\EditEstateDocumentOutput;
use App\Shared\Domain\Repositories\EstateDocumentRepository;
use Exception;

final class EditEstateDocumentUsecase implements EditEstateDocumentContract
{

    public function __construct(
        private readonly EstateDocumentRepository $estateDocumentRepository,
    ) {}
    public function execute(int $estateDocumentId, EditEstateDocumentOutput $presenter): void
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
}
