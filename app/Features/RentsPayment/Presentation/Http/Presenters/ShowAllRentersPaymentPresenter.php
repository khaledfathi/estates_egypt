<?php

declare(strict_types=1);

namespace App\Features\RentsPayment\Presentation\Http\Presenters;

use App\Features\RentsPayment\Application\Outputs\ShowAllRentersPaymentOutput;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;
use Closure;

final class ShowAllRentersPaymentPresenter implements ShowAllRentersPaymentOutput
{
    private Closure $response;
    public function onSuccess(UnitContractEntity $unitContractEntity, $entitiesWithPagination): void
    {
        $data = [
            'unitContract' => $unitContractEntity,
            'renter' => $unitContractEntity->renter,
            'unit' => $unitContractEntity->unit,
            'estate' => $unitContractEntity->unit->estate,
            'rentsPayment' => $entitiesWithPagination,
        ];
        $this->response = fn()=> view('rents-payment::index', $data);
    }
    public function onContractNotFound(): void
    {
        dd('success');
    }
    public function onFailure(string $error): void
    {
        dd('success');
    }
    public function handle()
    {
        return ($this->response)();
    }
}
