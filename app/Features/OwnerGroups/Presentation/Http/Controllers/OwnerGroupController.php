<?php

declare(strict_types=1);

namespace App\Features\OwnerGroups\Presentation\Http\Controllers;

use App\Features\OwnerGroups\Application\Contracts\DestroyOwnerGroupContract;
use App\Features\OwnerGroups\Application\Contracts\EditOwnerGroupContract;
use App\Features\OwnerGroups\Application\Contracts\ShowOwnerGroupContract;
use App\Features\OwnerGroups\Application\Contracts\ShowOwnerGroupsPaginationContract;
use App\Features\OwnerGroups\Application\Contracts\StoreOwnerGroupContract;
use App\Features\OwnerGroups\Application\Contracts\UnlinkOwnerFromGroupContract;
use App\Features\OwnerGroups\Application\Contracts\UpdateOwnerGroupContrat;
use App\Features\OwnerGroups\Presentation\Http\Presenters\DestroyOwnerGroupPresenter;
use App\Features\OwnerGroups\Presentation\Http\Presenters\EditOwnerGroupPresenter;
use App\Features\OwnerGroups\Presentation\Http\Presenters\ShowOwnerGroupPaginatePresenter;
use App\Features\OwnerGroups\Presentation\Http\Presenters\ShowOwnerGroupPresenter;
use App\Features\OwnerGroups\Presentation\Http\Presenters\StoreOwnerGroupPresenter;
use App\Features\OwnerGroups\Presentation\Http\Presenters\UnlinkOwnerFromGroupPresneter;
use App\Features\OwnerGroups\Presentation\Http\Presenters\UpdateOwnerGroupPresenter;
use App\Features\OwnerGroups\Presentation\Http\Requests\StoreOwnerGroupRequest;
use App\Features\OwnerGroups\Presentation\Http\Requests\UpdateOwnerGroupRequest;
use App\Http\Controllers\Controller;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use Illuminate\Http\Request;

class OwnerGroupController extends Controller
{
    public function __construct(
        private readonly ShowOwnerGroupContract $showOwnerGroupUsecase,
        private readonly ShowOwnerGroupsPaginationContract $showPaginateOwnerGroupUsecase,
        private readonly StoreOwnerGroupContract $storeOwnerGroupUsecase,
        private readonly DestroyOwnerGroupContract $destroyOwnerGroupUsecase,
        private readonly UpdateOwnerGroupContrat $updateOwnerGroupUsecase,
        private readonly EditOwnerGroupContract $editOwnerGroupUsecase,
        private readonly UnlinkOwnerFromGroupContract $unlinkOwnerFromGroupUsecase
    ) {}
    public function index()
    {

        $presenter = new ShowOwnerGroupPaginatePresenter();
        $this->showPaginateOwnerGroupUsecase->execute($presenter, 10);
        return  $presenter->handle();
    }
    public function show(string $ownerGroupId)
    {
        $presenter = new ShowOwnerGroupPresenter((int)$ownerGroupId);
        $this->showOwnerGroupUsecase->execute((int)$ownerGroupId, $presenter);
        return $presenter->handle();
    }
    public function create()
    {
        return view('owner-groups::create');
    }
    public function store(StoreOwnerGroupRequest $request)
    {
        //prepare data
        $ownerGroupEntity = $this->formToUnitEntity($request->all());
        //action
        $presenter = new StoreOwnerGroupPresenter();
        $this->storeOwnerGroupUsecase->execute($ownerGroupEntity, $presenter);
        return $presenter->handle();
    }
    public function edit(Request $request, string $ownerGroupId)
    {
        $presenter = new EditOwnerGroupPresenter();
        $this->editOwnerGroupUsecase->execute((int)$ownerGroupId, $presenter);
        return $presenter->handle();
    }
    public function update(UpdateOwnerGroupRequest $request, string $ownerGroupId)
    {
        $presenter = new UpdateOwnerGroupPresenter();
        $this->updateOwnerGroupUsecase->execute(
            $this->formToUnitEntity([...$request->all(), 'owner_group_id' => (int)$ownerGroupId]),
            $presenter
        );
        return $presenter->handle();
    }
    public function destroy(string $ownerGroupId)
    {
        $presenter = new DestroyOwnerGroupPresenter();
        $this->destroyOwnerGroupUsecase->execute((int)$ownerGroupId, $presenter);
        return $presenter->handle();
    }
    public function unlinkOwner(string $ownerGroupId , string $ownerInGroupId){
        $presenter = new UnlinkOwnerFromGroupPresneter((int)$ownerGroupId);
        $this->unlinkOwnerFromGroupUsecase->execute((int) $ownerInGroupId , $presenter);
        return $presenter->handle();
    }
    private function formToUnitEntity(array $formArray): OwnerGroupEntity
    {
        return new OwnerGroupEntity(
            id: $formArray['owner_group_id'] ?? null,
            name: $formArray['name'] ?? null,
        );
    }
}
