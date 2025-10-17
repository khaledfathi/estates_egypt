<?php

declare(strict_types=1);

namespace App\Features\Estates\Application\Usecases;

use App\Features\Estates\Application\Contracts\ShowPaginateEstateContract;
use App\Features\Estates\Application\Outputs\ShowEstatesPaginateOutput;
use App\Shared\Domain\Repositories\EstateRepositroy;

final class ShowPaginateEstateUsecase implements ShowPaginateEstateContract
{

    public function __construct(
        private readonly EstateRepositroy $estateRepositroy,
    ) {}
    public function execute(ShowEstatesPaginateOutput $presenter, int $perPage = 5): void
    {
        try {
            $presenter->onSucces($this->estateRepositroy->indexWithPaginate($perPage));
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
