<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServices\Application\Usecases;

use App\Features\EstateUtilityServices\Application\Contracts\EditEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Outputs\EditEstateUtilityServiceOutput;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\EstateUtilityServiceRepository;
use Exception;

final class EditEstateUtilityServiceUsecase implements EditEstateUtilityServiceContract
{

    public function __construct(
        private readonly EstateUtilityServiceRepository $estateUtilityServiceRepository,
        private readonly EstateRepositroy $estateRepositroy
    ) {}
    public function execute(int $estateUtilityServiceId, EditEstateUtilityServiceOutput $presenter): void
    {
        try {
            $estateUtilityServiceEntity = $this->estateUtilityServiceRepository->show($estateUtilityServiceId);
            if ($estateUtilityServiceEntity) {
                $estaetEntity = $this->estateRepositroy->show($estateUtilityServiceEntity->estateId);
                $estateUtilityServiceEntity->estate = $estaetEntity;
                $presenter->onSuccess($estateUtilityServiceEntity);
            } else {
                $presenter->onNotFound();
            }
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
