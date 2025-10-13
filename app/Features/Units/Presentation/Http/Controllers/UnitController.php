<?php

declare(strict_types=1);

namespace App\Features\Units\Presentation\Http\Controllers;

use App\Features\Units\Application\Contracts\DestroyUnitContract;
use App\Features\Units\Application\Contracts\ShowUnitContract;
use App\Features\Units\Application\Contracts\StoreUnitContract;
use App\Features\Units\Application\Contracts\UpdateUnitContract;
use App\Features\Units\Presentation\Http\Requests\StoreUnitRequest;
use App\Features\Units\Presentation\Http\Presenters\CreateUnitPresenter;
use App\Features\Units\Presentation\Http\Presenters\DestroyUnitPresenter;
use App\Features\Units\Presentation\Http\Presenters\EditUnitPresenter;
use App\Features\Units\Presentation\Http\Presenters\ShowUnitPresenter;
use App\Features\Units\Presentation\Http\Presenters\ShowUnitsPaginatePresenter;
use App\Features\Units\Presentation\Http\Presenters\StoreUnitPresenter;
use App\Features\Units\Presentation\Http\Presenters\UpdateUnitPresenter;
use App\Features\Units\Presentation\Http\Requests\UpdateUnitRequest;
use App\Http\Controllers\Controller;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\Enum\Unit\UnitType;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function __construct(
        private readonly ShowUnitContract $showUnitUsecase,
        private readonly StoreUnitContract $storeUnitUsecase,
        private readonly UpdateUnitContract $updateUnitUsecase,
        private readonly DestroyUnitContract $destroyUnitUsecase,
    ) {}

    public function index(Request $request)
    {
        $presenter = new ShowUnitsPaginatePresenter();
        $this->showUnitUsecase->allWithPaginate($presenter, (int) $request->route('estate'), 10);
        return $presenter->handle();
    }
    public function show(string $estateId , string $unitId)
    {
        $presenter = new ShowUnitPresenter();
        $this->showUnitUsecase->showById((int) $unitId, $presenter);
        return $presenter->handle();
    }

    public function edit(string $estaetId , string $unitId)
    {
        $presenter = new EditUnitPresenter();
        $this->updateUnitUsecase->edit((int) $unitId, $presenter);
        return $presenter->handle();
    }
    public function update(UpdateUnitRequest $request, string $estateId, string $unitId )
    {
        //prepeare data
        $unitEntity = $this->formToUnitEntity([...$request->all(), 'estate_id'=>$estateId ,'unit_id' => (int) $unitId]);
        //action
        $presenter = new UpdateUnitPresenter();
        $this->updateUnitUsecase->update($unitEntity, $presenter);
        return $presenter->handle();
    }
    public function create(Request $request)
    {
        $presenter = new CreateUnitPresenter();
        $this->storeUnitUsecase->create((int)$request->route('estate'), $presenter);
        return $presenter->handle();
    }

    public function store(StoreUnitRequest $request ,string $estateId)
    {
        //prepeare data
        $unitEntity = $this->formToUnitEntity([...$request->all(), 'estate_id'=> (int)$estateId]);
        //action
        $presenter = new StoreUnitPresenter((int) $request->estate_id);
        $this->storeUnitUsecase->store($unitEntity, $presenter);
        return $presenter->handle();
    }
    public function destroy( string $estateId , string $unitId)
    {
        $presenter = new DestroyUnitPresenter((int)$estateId);
        $this->destroyUnitUsecase->destroy((int)$unitId, $presenter);
        return $presenter->handle();
    }

    private function formToUnitEntity(array $formArray): UnitEntity
    {
        return new UnitEntity(
            id: $formArray['unit_id'] ?? null,
            estateId: (int)$formArray['estate_id'] ?? null,
            number: (int) $formArray['number'] ?? null,
            floorNumber: (int)$formArray['floor_number'] ?? null,
            type: UnitType::from($formArray['type']),
            isEmpty: $formArray['is_empty'] == 'true' ? true : false
        );
    }
}
