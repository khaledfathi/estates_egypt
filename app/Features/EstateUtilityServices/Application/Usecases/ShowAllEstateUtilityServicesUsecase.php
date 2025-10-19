<?php
declare (strict_types=1);
namespace App\Features\EstateUtilityServices\Application\Usecases;

use App\Features\EstateUtilityServices\Application\Contracts\ShowAllEstateUtilityServicesContract;
use App\Features\EstateUtilityServices\Application\Outputs\ShowAllEstateUtilityServicesOutputs;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\EstateUtilityServiceRepository;
use Exception;

final class ShowAllEstateUtilityServicesUsecase implements ShowAllEstateUtilityServicesContract {

    public function __construct(
        private readonly EstateRepositroy $estateRepositroy,
        private readonly EstateUtilityServiceRepository $estateUtilityServiceRepository
    ) {}
    public function execute(int $estateId, ShowAllEstateUtilityServicesOutputs $presenter):void{
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
}