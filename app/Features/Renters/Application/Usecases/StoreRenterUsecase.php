<?php
declare(strict_types= 1);

namespace App\Features\Renters\Application\Usecases;

use App\Features\Renters\Application\Contracts\StoreRenterContract;
use App\Features\Renters\Application\Outputs\StoreRenterOutput;
use App\Shared\Domain\Entities\Renter\RenterEntity;
use App\Shared\Domain\Repositories\RenterRepositroy;

final class StoreRenterUsecase implements  StoreRenterContract{

    public function __construct(
        private readonly RenterRepositroy $renterRepositroy
    ) { }
    /**
     * 
     * @inheritDoc
     */
    public function store(RenterEntity $renterEntity, StoreRenterOutput $presenter): void{
        try {
            $presenter->onSuccess($this->renterRepositroy->store($renterEntity));
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }  
    }
}