<?php

declare(strict_types=1);

namespace App\Features\Estates\Application\Usecases;

use App\Features\Estates\Application\Contracts\ShowEstateContract;
use App\Features\Estates\Application\Outputs\ShowEstateOutput;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\UnitRepository;

final class ShowEstateUsecase implements ShowEstateContract
{

    public function __construct(
        private readonly EstateRepositroy $estateRepositroy,
    ) {}
    public function execute(int $estateId, ShowEstateOutput $presenter): void
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
