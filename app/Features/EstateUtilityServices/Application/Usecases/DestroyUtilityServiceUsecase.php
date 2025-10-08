<?php
declare(strict_types=1);
namespace App\Features\EstateUtilityServices\Application\Usecases;

use App\Features\EstateUtilityServices\Application\Contracts\DestroyUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Outputs\DestroyEstateUtilityServiceOutput;
use App\Shared\Domain\Repositories\EstateUtilityServiceRepository;
use Exception;

final class DestroyUtilityServiceUsecase implements DestroyUtilityServiceContract {

    public function __construct(
        private readonly EstateUtilityServiceRepository $estateUtilityServiceRepository
    ){}
    public function destroy(int $EstateUtilityServiceId, DestroyEstateUtilityServiceOutput $presenter): void{
        try {
            $status= $this->estateUtilityServiceRepository->destroy($EstateUtilityServiceId);
            $presenter->onSuccess($status);
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
} 