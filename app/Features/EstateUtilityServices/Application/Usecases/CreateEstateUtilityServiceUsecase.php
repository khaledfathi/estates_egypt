<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServices\Application\Usecases;

use App\Features\EstateUtilityServices\Application\Contracts\CreateEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Outputs\CreateEstateUtilityServiceOutput;
use App\Shared\Domain\Enum\Estate\EstateUtilityServiceType;
use App\Shared\Domain\Repositories\EstateRepositroy;
use Exception;

final class CreateEstateUtilityServiceUsecase implements CreateEstateUtilityServiceContract
{
    public function __construct(
        private readonly EstateRepositroy $estateRepositroy,
    ) {}

    public function execute(int $estateId, CreateEstateUtilityServiceOutput $presenter): void
    {
        try {
            $estateEntity = $this->estateRepositroy->show($estateId);
            $estateUtilityServiceTypes = EstateUtilityServiceType::labels();
            $estateEntity
                ?  $presenter->onSuccess($estateEntity, $estateUtilityServiceTypes)
                : $presenter->onEstateNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
