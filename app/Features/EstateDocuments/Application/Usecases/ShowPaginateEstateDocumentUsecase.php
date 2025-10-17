<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Application\Usecases;

use App\Features\EstateDocuments\Application\Contracts\ShowPaginateEstateDocumentContract;
use App\Features\EstateDocuments\Application\Outputs\ShowEstateDocumentsPaginateOutput;
use App\Shared\Domain\Repositories\EstateDocumentRepository;
use App\Shared\Domain\Repositories\EstateRepositroy;

final class ShowPaginateEstateDocumentUsecase implements ShowPaginateEstateDocumentContract
{
    public function __construct(
        private readonly EstateDocumentRepository $estateDocumentRepository,
        private readonly EstateRepositroy $estateRepositroy
    ) {}
    public function execute(ShowEstateDocumentsPaginateOutput $presenter, int $estateId, int $perPage = 5): void
    {
        try {
            $estateDocumentsWithPagination = $this->estateDocumentRepository->indexWithPaginate($estateId, $perPage);
            $estateEntity = $this->estateRepositroy->show($estateId);
            if ($estateEntity) {
                $presenter->onSuccess($estateDocumentsWithPagination, $estateEntity);
            } else {
                $presenter->onEstateNotFound();
            }
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
