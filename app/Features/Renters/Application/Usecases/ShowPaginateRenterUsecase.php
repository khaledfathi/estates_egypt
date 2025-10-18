<?php

declare(strict_types=1);

namespace App\Features\Renters\Application\Usecases;

use App\Features\Renters\Application\Contracts\ShowRentersPaginationContract;
use App\Features\Renters\Application\Outputs\ShowRentersPaginationOutput;
use App\Shared\Domain\Repositories\RenterRepositroy;

final class ShowPaginateRenterUsecase implements ShowRentersPaginationContract
{

    public function __construct(
        private readonly RenterRepositroy $renterRepositroy
    ) {}
    public function execute(ShowRentersPaginationOutput $presenter, int $perPage = 5): void
    {
        try {
            $presenter->onSuccess($this->renterRepositroy->indexWithPaginate($perPage));
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
