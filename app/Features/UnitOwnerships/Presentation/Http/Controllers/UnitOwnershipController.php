<?php

declare(strict_types=1);

namespace App\Features\UnitOwnerships\Presentation\Http\Controllers;

use App\Features\UnitOwnerships\Application\Contracts\CreateUnitOwnershipContract;
use App\Features\UnitOwnerships\Application\Contracts\DestroyUnitOwnershipContract;
use App\Features\UnitOwnerships\Application\Contracts\StoreUnitOwnershipsByOwnersContract;
use App\Features\UnitOwnerships\Application\DTOs\OwnershipByOwnersFormDTO;
use App\Features\UnitOwnerships\Application\DTOs\OwnershipByOwnersGroupsDTO;
use App\Features\UnitOwnerships\Application\Usecases\StoreUnitOwnershipsByOwnerGoupsUsecase;
use App\Features\UnitOwnerships\Presentation\Http\Presenters\CreateUnitOwnershipPresenter;
use App\Features\UnitOwnerships\Presentation\Http\Presenters\DestroyUnitOwnershipPresenter;
use App\Features\UnitOwnerships\Presentation\Http\Presenters\StoreUnitOwnershipPresenter;
use App\Features\UnitOwnerships\Presentation\Http\Requests\StoreUnitOwnershipRequest;
use App\Http\Controllers\Controller;
use App\Shared\Domain\Entities\Unit\UnitOwnershipEntity;
use Illuminate\Http\Request;

class UnitOwnershipController extends Controller
{

    public const STORE_TYPE_OWNERS = 'owners_list';
    public const STORE_TYPE_OWNERS_GROUPS = 'owners_groups';
    public function __construct(
        private readonly StoreUnitOwnershipsByOwnersContract $storeUnitOwnershipsByOwnersContract,
        private readonly StoreUnitOwnershipsByOwnerGoupsUsecase $storeUnitOwnershipsByOwnerGoupsUsecase,
        private readonly CreateUnitOwnershipContract $createUnitOwnershipUsecase,
        private readonly DestroyUnitOwnershipContract $destroyUnitOwnershipUsecase,
    ) {}
    public function create(string $estateId, string $unitId)
    {
        $presenter = new CreateUnitOwnershipPresenter();
        $this->createUnitOwnershipUsecase->execute((int)$unitId, $presenter);
        return $presenter->handle();
    }
    public function store(StoreUnitOwnershipRequest $request, string $estateId, string $unitId)
    {
        $presenter = new StoreUnitOwnershipPresenter((int)$estateId, (int)$unitId);
        //
        if ($request?->store_type == self::STORE_TYPE_OWNERS) {
            $this->storeUnitOwnershipsByOwnersContract->execute(
                new OwnershipByOwnersFormDTO(
                    (int)$unitId,
                    $request->owners ?? []
                ),
                $presenter
            );
        } elseif ($request?->store_type == self::STORE_TYPE_OWNERS_GROUPS) {
            $this->storeUnitOwnershipsByOwnerGoupsUsecase->execute(new OwnershipByOwnersGroupsDTO(
                (int)$unitId,
                $request->groups ?? []
            ), $presenter);
        }
        return $presenter->handle();
    }
    public function destroy(int $estateId, int $unitId, int $unitOwnershipId)
    {
        $presenter = new DestroyUnitOwnershipPresenter();
        $this->destroyUnitOwnershipUsecase->execute($unitOwnershipId, $presenter);
        return $presenter->handle();
    }
}
