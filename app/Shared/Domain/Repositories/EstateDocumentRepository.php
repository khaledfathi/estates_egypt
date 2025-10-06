<?php
declare(strict_types= 1);

namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\EstateDocument\EstateDocumentEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface EstateDocumentRepository{
    /**
     * 
     * @return array<EstateDocumentEntity> 
     */
    public function index ():array;
    /**
     * 
     * @param int $perPage
     * @return EntitiesWithPagination<EstateDocumentEntity>
     */
    public function indexWithPaginate(int $estateId, int $perPage): EntitiesWithPagination;
    public function store(EstateDocumentEntity $estateDocumentEntity): EstateDocumentEntity;


    public function show(int $estateDocumentId , bool $estateDocumentOnly=false): EstateDocumentEntity|null;
    public function update (EstateDocumentEntity $estateDocumentEntity):bool;
    public function destroy (int $estateDocumentId):bool; 

}