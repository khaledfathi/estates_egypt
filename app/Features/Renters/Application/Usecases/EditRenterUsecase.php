<?php

declare(strict_types=1);

namespace App\Features\Renters\Application\Usecases;

use App\Features\Renters\Application\Contracts\EditRenterContract;
use App\Features\Renters\Application\Outputs\EditRenterOutput;
use App\Shared\Domain\Repositories\RenterRepositroy;

final class EditRenterUsecase implements EditRenterContract
{
    public function __construct(
        private readonly RenterRepositroy $renterRepositroy
    ) {}
    public function execute(int $renterId, EditRenterOutput $presenter): void
    {
        try {
            $record = $this->renterRepositroy->show($renterId);
            $record
                ? $presenter->onSuccess($record)
                : $presenter->onNotFound();
        } catch (\Exception $e) {
            $presenter->onFailure($e->getMessage());
        }
    }
}
