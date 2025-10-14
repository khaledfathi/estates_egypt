<?php
declare (strict_types=1);

namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface OwnerGroupRepository  {
    /**
     * 
     * @return array<OwnerGroupEntity> 
     */
    public function index():array;
    public function indexWithPaginate(int $perPage): EntitiesWithPagination;
    public function show(int $OwnerGroupId):OwnerGroupEntity|null;
    public function store (OwnerGroupEntity $ownerGroupEntity):OwnerGroupEntity;
    public function update(OwnerGroupEntity $ownerGroupEntity):bool;
    public function destroy(int $OwnerGroupId):bool;
}