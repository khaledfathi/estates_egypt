<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServices\Application\Usecases;

use App\Features\EstateUtilityServices\Application\Contracts\ShowEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Outputs\ShowAllEstateUtilityServicesOutputs;
use App\Features\EstateUtilityServices\Application\Outputs\ShowEstateUtilityServiceOutput;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\EstateUtilityServiceRepository;
use Exception;

final class ShowEstateUtilityServiceUsecase implements ShowEstateUtilityServiceContract
{
    public function __construct(
        private readonly EstateRepositroy $estateRepositroy,
        private readonly EstateUtilityServiceRepository $estateUtilityServiceRepository
    ) {}
    public function all(int $estateId, ShowAllEstateUtilityServicesOutputs $presenter): void
    {
        try {
            $estateEntity = $this->estateRepositroy->show($estateId);
            $estateUtilityServiceEntities = $this->estateUtilityServiceRepository->indexWhereEstate($estateId);
            $estateEntity
                ? $presenter->onSuccess($estateEntity, $estateUtilityServiceEntities)
                : $presenter->onNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
    public function showById(int $estateUtilitServiceId , ShowEstateUtilityServiceOutput $presenter):void{
        try {
            $estateUtilityServiceEntity = $this->estateUtilityServiceRepository->show($estateUtilitServiceId);
            if($estateUtilityServiceEntity){
                $estateEntity = $this->estateRepositroy->show($estateUtilityServiceEntity?->estateId);
                $estateUtilityServiceEntity->estate = $estateEntity;
                $presenter->onSuccess($estateUtilityServiceEntity);
            }else {
                $presenter->onNotFound();
            }
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }


}
