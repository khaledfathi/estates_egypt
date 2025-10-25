<?php
declare(strict_types=1);

namespace App\Features\EstateUtilityServices\Application\Usecases;

use App\Features\EstateUtilityServices\Application\Contracts\UpdateEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Outputs\EditEstateUtilityServiceOutput;
use App\Features\EstateUtilityServices\Application\Outputs\UpdateEstateUtilityServiceOutput;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceEntity;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\EstateUtilityServiceRepository;
use Exception;

final class  UpdateEstateUtilityServiceUsecase implements UpdateEstateUtilityServiceContract{
    public function __construct(
        private readonly EstateUtilityServiceRepository $estateUtilityServiceRepository,
        private readonly EstateRepositroy $estateRepositroy
    ){}
    public function Edit(int $estateUtilityServiceId, EditEstateUtilityServiceOutput $presenter): void{
    }
    public function execute(EstateUtilityServiceEntity $estateUtilityServiceEntity, UpdateEstateUtilityServiceOutput $presenter): void{
        try {
            $presenter->onSuccess( $this->estateUtilityServiceRepository->update($estateUtilityServiceEntity));
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
} 