<?php

declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Presentation\Http\Controllers;

use App\Features\UnitUtilityServices\Application\Contracts\DestroyUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Application\Contracts\ShowUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Application\Contracts\StoreUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Application\Contracts\UpdateUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Presentation\Http\Presenters\CreateUnitUtilityServicePresenter;
use App\Features\UnitUtilityServices\Presentation\Http\Presenters\DestroyUnitUtilityServicePresenter;
use App\Features\UnitUtilityServices\Presentation\Http\Presenters\EditUnitUtilityServicePresenter;
use App\Features\UnitUtilityServices\Presentation\Http\Presenters\ShowAllUnitUtilityServicePresenter;
use App\Features\UnitUtilityServices\Presentation\Http\Presenters\ShowUnitUtilityServicePresenter;
use App\Features\UnitUtilityServices\Presentation\Http\Presenters\StoreUnitUtilityServicesPresenter;
use App\Features\UnitUtilityServices\Presentation\Http\Presenters\UpdateUnitUtilityServicePresenter;
use App\Features\UnitUtilityServices\Presentation\Http\Requests\StoreUnitUtilityServiceRequest;
use App\Features\UnitUtilityServices\Presentation\Http\Requests\UpdateUnitUtilityServiceRequest;
use App\Http\Controllers\Controller;
use App\Shared\Domain\Entities\Unit\UnitUtilityServiceEntity;
use App\Shared\Domain\Enum\Unit\UnitUtilityServiceType;

class UnitUtilityServiceController extends Controller
{
    public function __construct(
        private readonly ShowUnitUtilityServiceContract $showUnitUtilityServiceUsecase,
        private readonly StoreUnitUtilityServiceContract $storeUnitUtilityServiceUsecase,
        private readonly DestroyUnitUtilityServiceContract $destroyUnitUtilityServiceUsecase,
        private readonly UpdateUnitUtilityServiceContract $updateUnitUtilityServiceUsecase,
    ) {}
    public function index(string $estateId, string $unitId)
    {
        $presenter = new ShowAllUnitUtilityServicePresenter();
        $this->showUnitUtilityServiceUsecase->all((int)$unitId, $presenter);
        return $presenter->handle();
    }
    public function show(string $estateId, string $unitId, string $utilityServiceId)
    {
        $presneter = new ShowUnitUtilityServicePresenter();
        $this->showUnitUtilityServiceUsecase->showById((int)$utilityServiceId, $presneter);
        return $presneter->handle();
    }
    public function create(string $estateId, string $unitId)
    {
        $presenter = new CreateUnitUtilityServicePresenter();
        $this->storeUnitUtilityServiceUsecase->create((int) $unitId, $presenter);
        return $presenter->handle();
    }
    public function store(StoreUnitUtilityServiceRequest $request, string $estateId, string $unitId)
    {
        //prepeate data 
        $unitUtilityServiceEntity = $this->formToUnitEntity([...$request->all(), 'unit' => (int)$unitId]);
        //action 
        $presenter = new StoreUnitUtilityServicesPresenter((int)$estateId, (int)$unitId);
        $this->storeUnitUtilityServiceUsecase->store($unitUtilityServiceEntity, $presenter);
        return $presenter->handle();
    }
    public function edit(string $estateId, string $unitId , string $unitUtilityServiceId )
    {
        $presenter = new EditUnitUtilityServicePresenter();
        $this->updateUnitUtilityServiceUsecase->edit((int) $unitUtilityServiceId , $presenter);
        return $presenter->handle();
    }
    public function update(UpdateUnitUtilityServiceRequest $request , string $estateId , string $unitId, string $unitUtilityServiceId)
    {
        //prepeate data 
        $unitUtilityServiceEntity = $this->formToUnitEntity([...$request->all(), 'unit' => (int)$unitId , 'id'=>(int)$unitUtilityServiceId]);
        //action
        $presenter = new UpdateUnitUtilityServicePresenter((int)$estateId , (int)$unitId);
        $this->updateUnitUtilityServiceUsecase->update($unitUtilityServiceEntity , $presenter);
        return $presenter->handle();
    }
    public function destroy(string $estateId , string $unitId , string $unitUtilityServiceId)
    {
        $presenter = new DestroyUnitUtilityServicePresenter((int)$estateId, (int)$unitId);
        $this->destroyUnitUtilityServiceUsecase->destroy((int)$unitUtilityServiceId, $presenter);
        return $presenter->handle();
    }
    private function formToUnitEntity(array $formArray): UnitUtilityServiceEntity
    {
        return new UnitUtilityServiceEntity(
            id: $formArray['id'] ?? null,
            unitId: (int)$formArray['unit'] ?? null,
            type: UnitUtilityServiceType::from($formArray['type']),
            ownerName: $formArray['owner_name'] ?? null,
            counterNumber: $formArray['counter_number'] ?? null,
            electronicPaymentNumber: $formArray['electronic_payment_number'] ?? null,
            notes: $formArray['notes'] ?? null,
        );
    }
}
