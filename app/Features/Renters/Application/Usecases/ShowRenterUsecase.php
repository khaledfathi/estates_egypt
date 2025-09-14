<?php

declare(strict_types=1);

namespace App\Features\Renters\Application\Usecases;

use App\Features\Renters\Application\Contracts\ShowRenterContract;
use App\Features\Renters\Application\Outputs\ShowRenterOutput;
use App\Features\Renters\Application\Outputs\ShowRentersPaginateOutput;
use App\Shared\Domain\Repositories\RenterRepositroy;

final class ShowRenterUsecase implements ShowRenterContract
{

    public function __construct(
        private readonly RenterRepositroy $renterRepositroy
    ) {}
    public function allWithPaginate(ShowRentersPaginateOutput $presenter, int $perPage = 5): void
    {
        try {
            $presenter->onSuccess($this->renterRepositroy->indexWithPaginate($perPage));
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }

    public function showById (int $renterId, ShowRenterOutput $presenter):void{
        try {
            $record = $this->renterRepositroy->show($renterId);
            $record 
                ? $presenter->onSuccess($record)
                : $presenter->onNotFount();

        }catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
