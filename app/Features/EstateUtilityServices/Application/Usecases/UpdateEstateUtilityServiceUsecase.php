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
        try {
            $estateUtilityServiceEntity= $this->estateUtilityServiceRepository->show($estateUtilityServiceId);
            if($estateUtilityServiceEntity){
                $estaetEntity= $this->estateRepositroy->show($estateUtilityServiceEntity->estateId);
                $estateUtilityServiceEntity->estate = $estaetEntity;
                $presenter->onSuccess($estateUtilityServiceEntity);
            }else {
                $presenter->onNotFound();
            }
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
    public function update(EstateUtilityServiceEntity $estateUtilityServiceEntity, UpdateEstateUtilityServiceOutput $presenter): void{
        try {
            $presenter->onSuccess( $this->estateUtilityServiceRepository->update($estateUtilityServiceEntity));
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
} 