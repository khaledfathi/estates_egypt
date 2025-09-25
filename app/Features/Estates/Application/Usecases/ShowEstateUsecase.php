<?php

declare(strict_types=1);

namespace App\Features\Estates\Application\Usecases;

use App\Features\Estates\Application\Contracts\ShowEstateContract;
use App\Features\Estates\Application\Outputs\ShowEstateOutput;
use App\Features\Estates\Application\Outputs\ShowEstatesPaginateOutput;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\UnitRepository;

final class ShowEstateUsecase implements ShowEstateContract
{

    public function __construct(
        private readonly EstateRepositroy $estateRepositroy,
        private readonly UnitRepository $unitRepository
    ) {}
    public function allWithPaginate(ShowEstatesPaginateOutput $presenter, int $perPage = 5): void
    {
        try {
            $presenter->onSucces($this->estateRepositroy->indexWithPaginate($perPage));
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
    public function showById(int $estateId, ShowEstateOutput $presenter): void
    {
        try {
            $estateEntity = $this->estateRepositroy->show($estateId);
            if ($estateEntity) {
                $presenter->onSuccess($estateEntity);
            } else {
                $presenter->onNotFound();
            }
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
