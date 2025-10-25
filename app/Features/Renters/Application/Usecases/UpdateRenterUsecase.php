<?php

declare(strict_types=1);

namespace App\Features\Renters\Application\Usecases;

use App\Features\Renters\Application\Contracts\UpdateRenterContract;
use App\Features\Renters\Application\Outputs\UpdateRenterOutput;
use App\Shared\Domain\Entities\Renter\RenterEntity;
use App\Shared\Domain\Repositories\RenterRepositroy;

final class UpdateRenterUsecase implements UpdateRenterContract
{

    public function __construct(
        private readonly RenterRepositroy $renterRepositroy
    ){}
    public function execute(RenterEntity  $renterEntity, UpdateRenterOutput $presenter): void{
        try {
            $presenter->onSuccess($this->renterRepositroy->update($renterEntity));
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
