<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServices\Presentation\Http\Controllers;

use App\Features\EstateUtilityServices\Application\Contracts\CreateEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Contracts\DestroyEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Contracts\EditEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Contracts\ShowAllEstateUtilityServicesContract;
use App\Features\EstateUtilityServices\Application\Contracts\ShowEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Contracts\StoreEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Contracts\UpdateEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Presentation\Http\Presenters\CreateEstateUtilityServicePresenter;
use App\Features\EstateUtilityServices\Presentation\Http\Presenters\DestroyEstateUtilityServicePresenter;
use App\Features\EstateUtilityServices\Presentation\Http\Presenters\EditEstateUtilityServicePresenter;
use App\Features\EstateUtilityServices\Presentation\Http\Presenters\ShowAllEstateUtilityServicesPresenter;
use App\Features\EstateUtilityServices\Presentation\Http\Presenters\ShowEstateUtilityServicePresenter;
use App\Features\EstateUtilityServices\Presentation\Http\Presenters\StoreEstateUtilityServicePresenter;
use App\Features\EstateUtilityServices\Presentation\Http\Presenters\UpdateEstateUtilityServicePresenter;
use App\Features\EstateUtilityServices\Presentation\Http\Requests\StoreEstateUtilityServiceRequest;
use App\Features\EstateUtilityServices\Presentation\Http\Requests\UpdateEstateUtilityServiceRequest;
use App\Http\Controllers\Controller;
use App\Shared\Domain\Entities\Estate\EstateUtilityServiceEntity;
use App\Shared\Domain\Enum\Estate\EstateUtilityServiceType;

class EstateUtilityServicesController extends Controller
{
    public function __construct(
        private readonly ShowEstateUtilityServiceContract $showEstateUtilityServiceUsecase,
        private readonly ShowAllEstateUtilityServicesContract $showAllEstateUtilityServicesUsecase, 
        private readonly StoreEstateUtilityServiceContract $storeEstateUtilityServiceUsecase,
        private readonly CreateEstateUtilityServiceContract $createEstateUtilityServiceUsecase,
        private readonly DestroyEstateUtilityServiceContract $destroyEstateUtilityServiceUsecase,
        private readonly EditEstateUtilityServiceContract $editEstateUtilityServiceUsecase,
        private readonly UpdateEstateUtilityServiceContract $updateEstateUtilityServiceUsecase,
    ) {}
    public function index(string $estaetId)
    {
        $presenter = new ShowAllEstateUtilityServicesPresenter();
        $this->showAllEstateUtilityServicesUsecase->execute((int)$estaetId, $presenter);
        return $presenter->handle();
    }

    public function create(string $estateId)
    {
        $presenter = new CreateEstateUtilityServicePresenter();
        $this->createEstateUtilityServiceUsecase->execute((int)$estateId, $presenter);
        return $presenter->handle();
    }

    public function store(StoreEstateUtilityServiceRequest $request)
    {
        //prepare data 
        $estateUtilityServiceEntity = $this->formToUnitEntity([...$request->all(), 'estate_id' => (int)$request->route('estate')]);
        //action 
        $presenter = new StoreEstateUtilityServicePresenter();
        $this->storeEstateUtilityServiceUsecase->execute($estateUtilityServiceEntity, $presenter);
        return $presenter->handle();
    }

    public function show(string $estateId, string $utilityServiceId)
    {
        $presenter = new ShowEstateUtilityServicePresenter();
        $this->showEstateUtilityServiceUsecase->execute((int)$utilityServiceId, $presenter);
        return $presenter->handle();
    }

    public function edit(string $estateId, string $estateUtilityServiceId)
    {
        $presenter = new EditEstateUtilityServicePresenter((int)$estateId);
        $this->editEstateUtilityServiceUsecase->execute((int)$estateUtilityServiceId, $presenter);
        return $presenter->handle();
    }

    public function update(UpdateEstateUtilityServiceRequest $request, string $estateId, string $estateUtilityServiceId)
    {
        //prepeare data
        $estateUtilityServiceEntity = $this->formToUnitEntity([
            ...$request->all(),
            'estate_id' => (int)$estateId,
            'id' => (int)$estateUtilityServiceId
        ]);
        //action
        $presnter = new UpdateEstateUtilityServicePresenter((int)$estateId);
        $this->updateEstateUtilityServiceUsecase->execute($estateUtilityServiceEntity, $presnter);
        return $presnter->handle();
    }

    public function destroy(string $estaetId, string $estateUtilityServiceId)
    {
        $presenter = new DestroyEstateUtilityServicePresenter((int)$estaetId);
        $this->destroyEstateUtilityServiceUsecase->execute((int)$estateUtilityServiceId, $presenter);
        return $presenter->handle();
    }
    private function formToUnitEntity(array $formArray): EstateUtilityServiceEntity
    {
        return new EstateUtilityServiceEntity(
            id: $formArray['id'] ?? null,
            estateId: (int)$formArray['estate_id'] ?? null,
            type: EstateUtilityServiceType::from($formArray['type']),
            ownerName: $formArray['owner_name'] ?? null,
            counterNumber: $formArray['counter_number'] ?? null,
            electronicPaymentNumber: $formArray['electronic_payment_number'] ?? null,
            notes: $formArray['notes'] ?? null,
        );
    }
}
