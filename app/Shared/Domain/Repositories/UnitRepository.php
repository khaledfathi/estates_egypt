<?php
declare (strict_types= 1);
namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface UnitRepository{
    /**
     * 
     * @return array<UnitEntity> 
     */
    public function index ():array;
    /**
     * 
     * @param int $estateId
     * @param int $perPage
     * @return EntitiesWithPagination<UnitEntity> 
     */
    public function indexWithPaginate(int $estateId , int $perPage): EntitiesWithPagination;


    public function store (UnitEntity $unitEntity):UnitEntity;

    /**
     * 
     * @param int $unitId
     * @param bool $unitOnly query with out estate related data
     * @return void
     */
    public function show (int $unitId , bool $unitOnly=false):UnitEntity|null;
    public function update (UnitEntity $unitEntity):bool;
    public function destroy (int $unitId):bool; 
}