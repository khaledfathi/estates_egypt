<?php
declare (strict_types= 1);
namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\Owner\OwnerEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;


interface OwnerRepository{
    /**
     * 
     * @return array<OwnerEntity> 
     */
    public function index ():array;
    public function indexWithPaginate(int $perPage): EntitiesWithPagination;


    public function store (OwnerEntity $ownerEntities):OwnerEntity;

    public function show (int $ownerId):OwnerEntity|null;
    public function update (ownerEntity $ownerEntity):bool;
    public function destroy (int $ownerId):bool; 

}