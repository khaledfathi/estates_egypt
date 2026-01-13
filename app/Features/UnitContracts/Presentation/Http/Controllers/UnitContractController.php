<?php

declare(strict_types=1);

namespace App\Features\UnitContracts\Presentation\Http\Controllers;

use App\Features\UnitContracts\Application\Contracts\CreateUnitContractContract;
use App\Features\UnitContracts\Application\Contracts\DestroyUnitContractContract;
use App\Features\UnitContracts\Application\Contracts\EditUnitContractContract;
use App\Features\UnitContracts\Application\Contracts\ShowUnitContractContract;
use App\Features\UnitContracts\Application\Contracts\ShowUnitContractsPaginationContract;
use App\Features\UnitContracts\Application\Contracts\StoreUnitContractContract;
use App\Features\UnitContracts\Application\Contracts\UpdateUnitContractContract;
use App\Features\UnitContracts\Presentation\Http\Presenters\CreateUnitContractContractPresenter;
use App\Features\UnitContracts\Presentation\Http\Presenters\DestroyUnitContractPresenter;
use App\Features\UnitContracts\Presentation\Http\Presenters\EditUnitContractPresenter;
use App\Features\UnitContracts\Presentation\Http\Presenters\ShowUnitContractPresenter;
use App\Features\UnitContracts\Presentation\Http\Presenters\ShowUnitContractsPaginationPresenter;
use App\Features\UnitContracts\Presentation\Http\Presenters\StoreUnitContractPresenter;
use App\Features\UnitContracts\Presentation\Http\Presenters\UpdateUnitContractPresenter;
use App\Features\UnitContracts\Presentation\Http\Requests\StoreUnitContractRequest;
use App\Features\UnitContracts\Presentation\Http\Requests\UpdateUnitContractRequest;
use App\Http\Controllers\Controller;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;
use App\Shared\Domain\Enum\Unit\UnitContractType;
use App\Shared\Infrastructure\Utilities\CarbonDateUtility;

class UnitContractController extends Controller
{
    public function __construct(
        private readonly ShowUnitContractsPaginationContract $showUnitContractsPaginationUsecase,
        private readonly CreateUnitContractContract $createUnitContractUsecase,
        private readonly StoreUnitContractContract $storeUnitContractUsecase,
        private readonly ShowUnitContractContract $showUnitContractUsecase,
        private readonly EditUnitContractContract $editUnitContractUsecase,
        private readonly UpdateUnitContractContract $updateUnitContractContract,
        private readonly DestroyUnitContractContract $destroyUnitContractContract,
    ) {}

    public function index($estateId, string $unitId)
    {
        $presenter = new ShowUnitContractsPaginationPresenter();
        $this->showUnitContractsPaginationUsecase->execute((int)$unitId, $presenter, 5);
        return $presenter->handle();
    }
    public function show(int $estateId, int $unitId, int $unitContractId)
    {
        $presenter = new ShowUnitContractPresenter();
        $this->showUnitContractUsecase->execute($unitContractId, $presenter);
        return $presenter->handle();
    }

    public function edit(string $estateId, string $unitId, string $unitContractId)
    {
        $presenter = new EditUnitContractPresenter((int)$estateId, (int)$unitId);
        $this->editUnitContractUsecase->execute((int)$unitContractId, $presenter);
        return $presenter->handle();
    }
    public function update(UpdateUnitContractRequest $request, string $estateId, string $unitId, string $unitContractId)
    {
        //prepeate date 
        $unitContractEntity =  $this->formToUnitContractEntity([...$request->all(), 'unit_contract_id' => (int)$unitContractId, 'unit_id' => (int)$unitId]);
        //action
        $presenter = new UpdateUnitContractPresenter((int) $estateId, (int) $unitId, (int) $unitContractId);
        $this->updateUnitContractContract->execute($unitContractEntity, $presenter);
        return $presenter->handle();
    }
    public function create(string $estateId, string $unitId)
    {
        $presenter = new CreateUnitContractContractPresenter();
        $this->createUnitContractUsecase->execute((int)$unitId, $presenter);
        return $presenter->handle();
    }

    public function store(StoreUnitContractRequest $request, string $estateId, string $unitId)
    {
        //prepare datea
        $unitContractEntity =  $this->formToUnitContractEntity([...$request->all(), 'unit_id' => (int)$unitId]);
        //action 
        $presenter = new StoreUnitContractPresenter((int)$estateId, (int)$unitId);
        $this->storeUnitContractUsecase->execute($unitContractEntity, $presenter);
        return $presenter->handle();
    }
    public function destroy(string $estateId, string $unitId, string $unitContractId)
    {
        $presenter = new DestroyUnitContractPresenter((int)$estateId, (int)$unitId, (int) $unitContractId);
        $this->destroyUnitContractContract->execute((int)$unitContractId, $presenter);
        return $presenter->handle();
    }
    private function formToUnitContractEntity(array $formArray): UnitContractEntity
    {
        return new UnitContractEntity(
            id: $formArray['unit_contract_id'] ?? null,
            unitId: (int)$formArray['unit_id'] ?? null,
            renterId: isset($formArray['renter_id']) ? (int)$formArray['renter_id'] : null,
            type: UnitContractType::from($formArray['contract_type']),
            rentValue: (int)$formArray['rent_value'] ?? null,
            annualRentIncreasement: (int)$formArray['annual_rent_increasement'] ?? null,
            insuranceValue: (int)$formArray['insurance_value'] ?? null,
            startDate: $formArray['start_date'] ? CarbonDateUtility::from($formArray['start_date']) : null,
            endDate: $formArray['end_date'] ? CarbonDateUtility::from($formArray['end_date']) : null,
            waterInvoicePercentage: (float)$formArray['water_invoice_percentage'] ?? null,
            electricityInvoicePercentage: (float)$formArray['electricity_invoice_percentage'] ?? null,

        );
    }
}
