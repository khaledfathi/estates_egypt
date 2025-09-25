<?php
declare(strict_types= 1);

namespace App\Shared\Domain\Repositories;

use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface EstateRepositroy {
    /**
     * 
     * @return array<EstateEntity> 
     */
    public function index ():array;
    public function indexWithPaginate(int $perPage): EntitiesWithPagination;
    public function store (EstateEntity $estateEntity):EstateEntity;

    public function show (int $estateId):EstateEntity|null;
    public function update (EstateEntity $estateEntity):bool;
    public function destroy (int $estateId):bool; 

}