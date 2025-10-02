<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Repositories\Eloquent;

use App\Features\EstateDocuments\Domain\ValueObjects\EstateDocumentEntitiesWithPagination;
use App\Shared\Domain\Entities\EstateDocument\EstateDocumentEntity;
use App\Shared\Domain\Repositories\EstateDocumentRepository;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Domain\ValueObjects\Pagination;
use App\Shared\Infrastructure\Models\Estate\EstateDocument;

final class EloquentEstateDocumentRepository implements EstateDocumentRepository
{
    /**
     * 
     * @inheritDoc 
     */
    public function index(): array
    {
        return [];
    }
    /**
     * 
     * @inheritDoc
     */
    public function indexWithPaginate(int $estateId, int $perPage): EntitiesWithPagination
    {
        //Query 
        $estateDocumentRecords = EstateDocument::where('estate_id', $estateId)
            ->orderBy('type', 'desc')->orderBy('number', 'asc')
            ->paginate($perPage);
        //Transform to DTO
        $arrayOfEstateDocuments = [];
        foreach ($estateDocumentRecords as $record) {
            //units DTO
            $arrayOfEstateDocuments[] = new EstateDocumentEntity(
                id: (int) $record->id,
                estateId: $record->estate_id,
                title: $record->title,
                description: $record->description,
                file: $record->file,
            );
        }
        //Pagination DTO
        $paginationData = new Pagination(
            perPage: $estateDocumentRecords->perPage(),
            currentPage: $estateDocumentRecords->currentPage(),
            path: $estateDocumentRecords->path(),
            pageName: $estateDocumentRecords->getPageName(),
            total: $estateDocumentRecords->total(),
        );
        //Final DTO
        return  new EstateDocumentEntitiesWithPagination(
            $paginationData,
            $arrayOfEstateDocuments
        );
    }
    public function store(EstateDocumentEntity $estateDocumentEntity): EstateDocumentEntity
    {
        $record = EstateDocument::create([
            'estate_id' => $estateDocumentEntity->estateId,
            'title' => $estateDocumentEntity->title,
            'description' => $estateDocumentEntity->description,
            'file' => $estateDocumentEntity->file,
        ]);
        $estateDocumentEntity->id = $record->id;
        return $estateDocumentEntity;
    }
    public function show(int $estateDocumentId): EstateDocumentEntity|null
    {

        $record = EstateDocument::find($estateDocumentId);
        if ($record) {
            return new EstateDocumentEntity(
                id: $record->id,
                estateId:$record->estate_id,
                title: $record->title,
                description: $record->description,
                file: $record->file,
            );
        }
        return null;
    }
    public function update(EstateDocumentEntity $estateEntity): bool
    {
        return false;
    }
    public function destroy(int $estateId): bool
    {
        return EstateDocument::find($estateId)->delete();
    }
}
