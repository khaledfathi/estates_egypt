<?php
declare (strict_types= 1);
namespace App\Shared\Domain\Repositories;

use App\Features\Owners\Application\DTOs\OwnerEntitiesWithPagination;
use App\Shared\Domain\Entities\OwnerEntity;

interface OwnerRepository{
    /**
     * 
     * @return array<OwnerEntity> 
     */
    public function index ():array;
    public function indexWithPaginate(int $paginate): OwnerEntitiesWithPagination;

    public function store (OwnerEntity $ownerEntities):OwnerEntity;

    public function show (int $ownerId):OwnerEntity|null;
    public function update (ownerEntity $ownerEntity):bool;
    public function destroy (int $ownerId):bool; 

}