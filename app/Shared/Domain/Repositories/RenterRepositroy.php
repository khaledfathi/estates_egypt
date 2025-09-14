<?php
declare(strict_types= 1); 

namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Domain\Entities\Renter\RenterEntity;

interface RenterRepositroy {
    /**
     * 
     * @return array<RenterEntity> 
     */
    public function index ():array;
    public function indexWithPaginate(int $perPage): EntitiesWithPagination;


    public function store (RenterEntity $renterEntities):RenterEntity;

    public function show (int $renterId):RenterEntity|null;
    public function update (RenterEntity$renterEntity):bool;
    public function destroy (int $renterId):bool; 

}