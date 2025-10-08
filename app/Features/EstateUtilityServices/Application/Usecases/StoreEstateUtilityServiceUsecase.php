<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServices\Application\Usecases;

use App\Features\EstateUtilityServices\Application\Contracts\StoreEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Outputs\CreateEstateUtilityServiceOutput;
use App\Features\EstateUtilityServices\Application\Outputs\StoreEstateUtilityServiceOutput;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceEntity;
use App\Shared\Domain\Enum\Estate\EstateUtilityServiceType;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\EstateUtilityServiceRepository;
use Exception;

final class StoreEstateUtilityServiceUsecase implements StoreEstateUtilityServiceContract
{

    public function __construct(
        private readonly EstateUtilityServiceRepository $estateUtilityServiceRepository,
        private readonly EstateRepositroy $estateRepositroy,
    ) {}
    public function create(int $estateId, CreateEstateUtilityServiceOutput $presenter): void
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
    public function store(EstateUtilityServiceEntity $estateUtilityServiceEntity, StoreEstateUtilityServiceOutput $presenter): void
    {
        try {
            $record = $this->estateUtilityServiceRepository->store($estateUtilityServiceEntity);
            $presenter->onSuccess($record);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
