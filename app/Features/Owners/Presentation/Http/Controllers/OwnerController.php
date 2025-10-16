<?php
declare(strict_types=1);

namespace App\Features\Owners\Presentation\Http\Controllers;

use App\Features\Owners\Application\Contracts\DestroyOwnerContract;
use App\Features\Owners\Application\Contracts\ShowOwnerContract;
use App\Features\Owners\Application\Contracts\StoreOwnerContract;
use App\Features\Owners\Application\Contracts\UpdateOwnerContract;
use App\Features\Owners\Presentation\API\Presenters\CreateOwnerPresenter;
use App\Features\Owners\Presentation\Http\Presenters\DestroyOwnerPresenter;
use App\Features\Owners\Presentation\Http\Presenters\EditOwnerPresenter;
use App\Features\Owners\Presentation\Http\Presenters\ShowOwnerPresenter;
use App\Features\Owners\Presentation\Http\Presenters\ShowOwnersPaginatePresenter;
use App\Features\Owners\Presentation\Http\Presenters\StoreOwnerPresenter;
use App\Features\Owners\Presentation\Http\Presenters\UpdateOwnerPresenter;
use App\Features\Owners\Presentation\Http\Requests\StoreOwnerRequest;
use App\Features\Owners\Presentation\Http\Requests\UpdateOwnerRequest;
use App\Http\Controllers\Controller;
use App\Models\OwnerGroup;
use App\Shared\Domain\Entities\Owner\OwnerEntity;
use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Domain\Entities\Owner\OwnerPhoneEntity;

class  OwnerController extends Controller
{
    public function __construct(
        private readonly ShowOwnerContract $showOwnerUsecase,
        private readonly StoreOwnerContract $storeOwnerUsecase,
        private readonly UpdateOwnerContract $updateOwnerUsecase,
        private readonly DestroyOwnerContract $destroyOwnerUsecase

    ) {}

    public function index()
    {
        $presenter = new ShowOwnersPaginatePresenter();
        $this->showOwnerUsecase->allWithPaginate($presenter, 5);

        return $presenter->handle();
    }

    public function show(string $id)
    {
        $presenter = new ShowOwnerPresenter();
        $this->showOwnerUsecase->showById((int) $id, $presenter);
        return $presenter->handle();
    }

    public function edit(string $id)
    {
        $presenter = new EditOwnerPresenter();
        $this->updateOwnerUsecase->edit((int) $id, $presenter);
        return $presenter->handle();
    }
    public function update(UpdateOwnerRequest $request, string $id)
    {
        //prepeare data
        $ownerEntity = $this->formToOwnerEntity([...$request->all(), 'id' => (int) $id]);
        //action
        $presenter = new UpdateOwnerPresenter();
        $this->updateOwnerUsecase->update($ownerEntity, $presenter);
        return $presenter->handle();
    }
    public function create()
    {
        $presenter = new CreateOwnerPresenter();
        $this->storeOwnerUsecase->create($presenter);
        return $presenter->handle();
    }

    public function store(StoreOwnerRequest $request)
    {
        //prepeare data
        $ownerEntity = $this->formToOwnerEntity($request->all());
        //action
        $presenter = new StoreOwnerPresenter();
        $this->storeOwnerUsecase->store($ownerEntity, $presenter);
        return $presenter->handle();
    }
    public function destroy(string $id)
    {
        $presenter = new DestroyOwnerPresenter();
        $this->destroyOwnerUsecase->destroy((int) $id, $presenter);
        return $presenter->handle();
    }

    private function formToOwnerEntity(array $formArray): OwnerEntity
    {
        //----
        $ownerPhones = [];
        if (isset($formArray["phones"])) {
            foreach ($formArray["phones"] as $phone) {
                $ownerPhones[] = new OwnerPhoneEntity(phone: $phone);
            }
        }
        //----
        $ownerGroups = [];
        if (isset($formArray["owner_groups"])) {
            foreach ($formArray["owner_groups"] as $ownerGroupId) {
                $ownerGroups[] = new OwnerGroupEntity((int)$ownerGroupId);
            }
        }
        //return owner entity with phones if exist
        return new OwnerEntity(
            id:$formArray['id'] ?? null,
            name:$formArray['name'] ?? null,
            nationalId:$formArray['national_id'] ?? null,
            address:$formArray['address'] ?? null,
            phones:$ownerPhones,
            notes:$formArray['notes'] ?? null,
            ownerGroups:$ownerGroups 
        );
    }
}
