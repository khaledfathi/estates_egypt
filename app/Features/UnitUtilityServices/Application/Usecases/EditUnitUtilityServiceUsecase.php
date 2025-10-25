<?php

declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Application\Usecases;

use App\Features\UnitUtilityServices\Application\Contracts\EditUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Application\Outputs\EditUnitUtilityServiceOutput;
use App\Shared\Domain\Repositories\UnitUtilityServiceRepository;
use Exception;

final class EditUnitUtilityServiceUsecase implements EditUnitUtilityServiceContract
{
    public function __construct(
        private readonly UnitUtilityServiceRepository $unitUtilityServiceRepository
    ) {}
    public function execute(int $unitUtilityServiceId, EditUnitUtilityServiceOutput $presenter): void
    {
        try {
            $record = $this->unitUtilityServiceRepository->show($unitUtilityServiceId);
            $record
                ? $presenter->onSuccess($record)
                : $presenter->onNotFound();
        } catch (Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
