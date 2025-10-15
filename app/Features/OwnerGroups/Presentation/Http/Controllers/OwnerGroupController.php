<?php

declare(strict_types=1);

namespace App\Features\OwnerGroups\Presentation\Http\Controllers;

use App\Features\OwnerGroups\Application\Contracts\DestroyOwnerGroupContract;
use App\Features\OwnerGroups\Application\Contracts\ShowOwnerGroupContract;
use App\Features\OwnerGroups\Application\Contracts\StoreOwnerGroupContract;
use App\Features\OwnerGroups\Application\Contracts\UpdateOwnerGroupContrat;
use App\Features\OwnerGroups\Presentation\Http\Presenters\DestroyOwnerGroupPresnter;
use App\Features\OwnerGroups\Presentation\Http\Presenters\EditOwnerGroupPresenter;
use App\Features\OwnerGroups\Presentation\Http\Presenters\ShowOwnerGroupPaginatePresenter;
use App\Features\OwnerGroups\Presentation\Http\Presenters\StoreOwnerGroupPresenter;
use App\Features\OwnerGroups\Presentation\Http\Requests\StoreOwnerGroupRequest;
use App\Http\Controllers\Controller;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use Illuminate\Http\Request;

class OwnerGroupController extends Controller
{
    public function __construct(
        private readonly ShowOwnerGroupContract $showOwnerGroupUsecase,
        private readonly StoreOwnerGroupContract $storeOwnerGroupUsecase,
        private readonly DestroyOwnerGroupContract $destroyOwnerGroupUsecase,
        private readonly UpdateOwnerGroupContrat $updateOwnerGroupUsecase,
    ) {}
    public function index()
    {

        $presenter = new ShowOwnerGroupPaginatePresenter();
        $this->showOwnerGroupUsecase->allWithPaginate($presenter, 10);
        return  $presenter->handle();
    }
    public function show()
    {
        return __CLASS__ . "::" . __FUNCTION__;
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
        $this->storeOwnerGroupUsecase->store($ownerGroupEntity, $presenter);
        return $presenter->handle();
    }
    public function edit(Request $request ,string $ownerGroupId)
    {
        $presenter = new EditOwnerGroupPresenter(); 
        $this->updateOwnerGroupUsecase->edit((int)$ownerGroupId , $presenter);
        return $presenter->handle();
    }
    public function update()
    {
        return __CLASS__ . "::" . __FUNCTION__;
    }
    public function destroy(string $ownerGroupId)
    {
        $presenter = new DestroyOwnerGroupPresnter();
        $this->destroyOwnerGroupUsecase->destroy((int)$ownerGroupId , $presenter);
        return $presenter->handle(); 
    }
    private function formToUnitEntity(array $formArray): OwnerGroupEntity
    {
        return new OwnerGroupEntity(
            name: $formArray['name'] ?? null,
        );
    }
}
