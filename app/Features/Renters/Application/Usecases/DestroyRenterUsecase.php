<?php
declare(strict_types= 1);

namespace App\Features\Renters\Application\Usecases;

use App\Features\Renters\Application\Contracts\DestroyRenterContract;
use App\Features\Renters\Application\Outputs\DestroyRenterOutput;
use App\Shared\Domain\Repositories\RenterRepositroy;

final class DestroyRenterUsecase implements DestroyRenterContract {

    public function __construct(
        private readonly RenterRepositroy $renterRepositroy
    ){ }
    public function execute(int $renterId , DestroyRenterOutput $presenter): void{
        try {
            $presenter->onSuccess($this->renterRepositroy->destroy($renterId));
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}