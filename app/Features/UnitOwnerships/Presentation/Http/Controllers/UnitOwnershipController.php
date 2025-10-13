<?php

declare(strict_types=1);

namespace App\Features\UnitOwnerships\Presentation\Http\Controllers;

use App\Features\UnitOwnerships\Application\Contracts\DestroyUnitOwnershipContract;
use App\Features\UnitOwnerships\Application\Contracts\StoreUnitOwnershipContract;
use App\Features\UnitOwnerships\Presentation\Http\Presenters\CreateUnitOwnershipPresenter;
use App\Features\UnitOwnerships\Presentation\Http\Presenters\DestroyUnitOwnershipPresenter;
use App\Features\UnitOwnerships\Presentation\Http\Presenters\StoreUnitOwnershipPresenter;
use App\Features\UnitOwnerships\Presentation\Http\Requests\StoreUnitOwnershipReques;
use App\Http\Controllers\Controller;
use App\Shared\Domain\Entities\Unit\UnitOwnershipEntity;

class UnitOwnershipController extends Controller
{

    public function __construct(
        private readonly StoreUnitOwnershipContract $storeUnitOwnershipUsecase,
        private readonly DestroyUnitOwnershipContract $destroyUnitOwnershipUsecase,
    ) {}
    public function create(string $estateId, string $unitId)
    {
        $presenter = new CreateUnitOwnershipPresenter();
        $this->storeUnitOwnershipUsecase->create((int)$unitId, $presenter);
        return $presenter->handle();
    }
    public function store(StoreUnitOwnershipReques $request, string $estateId, string $unitId)
    {
        //prepeare data 
        $unitOwnershipEntity = $this->formToUnitEntity([...$request->all() , 'unit_id'=>(int)$unitId]);
        //action
        $presenter = new StoreUnitOwnershipPresenter((int)$estateId , (int)$unitId);
        $this->storeUnitOwnershipUsecase->store($unitOwnershipEntity , $presenter);
        return $presenter->handle();
    }
    public function destroy(int $estateId, int $unitId, int $unitOwnershipId){
        $presenter = new DestroyUnitOwnershipPresenter();
        $this->destroyUnitOwnershipUsecase->destroy($unitOwnershipId , $presenter);
        return $presenter->handle();
    }
    private function formToUnitEntity(array $formArray)
    {
        return new UnitOwnershipEntity(
            unitId: $formArray['unit_id'] ?? null,
            ownerId: (int)$formArray['owner_id'] ?? null,
        );
    }
}
