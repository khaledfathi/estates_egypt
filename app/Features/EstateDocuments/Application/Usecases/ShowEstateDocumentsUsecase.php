<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Usecases;

use App\Features\EstateDocuments\Application\Contracts\ShowEstateDocumentContract;
use App\Features\EstateDocuments\Application\Outputs\ShowEstateDocumentOutput;
use App\Shared\Domain\Repositories\EstateDocumentRepository;

final class ShowEstateDocumentsUsecase implements ShowEstateDocumentContract
{

    public function __construct(
        private readonly EstateDocumentRepository $estateDocumentRepository,
    ) {}
    public function execute(int $estateDocuemntId, ShowEstateDocumentOutput $presenter): void
    {
        try {
            $estateDocumentRecord = $this->estateDocumentRepository->show($estateDocuemntId);
            $estateDocumentRecord
                ?  $presenter->onSuccess($estateDocumentRecord)
                : $presenter->onNotFound();
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
