<?php

declare(strict_types=1);

namespace App\Features\Renters\Application\Usecases;

use App\Features\Renters\Application\Contracts\ShowPaginateRenterContract;
use App\Features\Renters\Application\Outputs\ShowRentersPaginateOutput;
use App\Shared\Domain\Repositories\RenterRepositroy;

final class ShowPaginateRenterUsecase implements ShowPaginateRenterContract
{

    public function __construct(
        private readonly RenterRepositroy $renterRepositroy
    ) {}
    public function execute(ShowRentersPaginateOutput $presenter, int $perPage = 5): void
    {
        try {
            $presenter->onSuccess($this->renterRepositroy->indexWithPaginate($perPage));
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
