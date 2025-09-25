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
use App\Shared\Domain\Enum\Unit\UnitOwnershipType;
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
        $this->showUnitUsecase->allWithPaginate($presenter, (int) $request->estate_id, 10);
        return $presenter->handle();
    }
    public function show(string $id)
    {
        $presenter = new ShowUnitPresenter();
        $this->showUnitUsecase->showById((int)$id, $presenter);
        return $presenter->handle();
    }

    public function edit(string $id, Request $request)
    {
        $presenter = new EditUnitPresenter();
        $this->updateUnitUsecase->edit((int) $id, $presenter);
        return $presenter->handle();
    }
    public function update(UpdateUnitRequest $request, string $id)
    {
        //prepeare data
        $unitEntity = $this->formToUnitEntity([...$request->all(), 'id' => (int) $id]);
        //action
        $presenter = new UpdateUnitPresenter();
        $this->updateUnitUsecase->update($unitEntity, $presenter);
        return $presenter->handle();
    }
    public function create(Request $request)
    {
        $presenter = new CreateUnitPresenter();
        $this->storeUnitUsecase->create((int)$request->estate_id, $presenter);
        return $presenter->handle();
    }

    public function store(StoreUnitRequest $request)
    {
        //prepeare data
        $unitEntity = $this->formToUnitEntity($request->all());
        //action
        $presenter = new StoreUnitPresenter((int) $request->estate_id);
        $this->storeUnitUsecase->store($unitEntity, $presenter);
        return $presenter->handle();
    }
    public function destroy(string $id)
    {
        $presenter = new DestroyUnitPresenter();
        $this->destroyUnitUsecase->destroy((int)$id, $presenter);
        return $presenter->handle();
    }

    private function formToUnitEntity(array $formArray): UnitEntity
    {
        return new UnitEntity(
            id: $formArray['id'] ?? null,
            estateId: (int)$formArray['estate_id'] ?? null,
            number: (int) $formArray['number'] ?? null,
            floorNumber: (int)$formArray['floor_number'] ?? null,
            type: UnitType::from($formArray['type']),
            ownershipType: UnitOwnershipType::from($formArray['ownership_type']),
            isEmpty: $formArray['is_empty'] == 'true' ? true : false
        );
    }
}
