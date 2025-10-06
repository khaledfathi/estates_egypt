<?php

namespace App\Features\Owners\Presentation\API\Controllers;

use App\Features\Owners\Application\Contracts\DestroyOwnerContract;
use App\Features\Owners\Application\Contracts\ShowOwnerContract;
use App\Features\Owners\Application\Contracts\StoreOwnerContract;
use App\Features\Owners\Application\Contracts\UpdateOwnerContract;
use App\Features\Owners\Presentation\API\Presenters\DestroyOwnerPresenter;
use App\Features\Owners\Presentation\API\Presenters\ShowOwnerPresenter;
use App\Features\Owners\Presentation\API\Presenters\ShowOwnersPaginatePresenter;
use App\Features\Owners\Presentation\API\Presenters\StoreOwnerPresenter;
use App\Features\Owners\Presentation\API\Presenters\UpdateOwnerPresenter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OwnerController extends Controller
{

    public function __construct(
        private readonly ShowOwnerContract $showOwnerUsecase,
        private readonly StoreOwnerContract $createOwnerUsecase,
        private readonly UpdateOwnerContract $updateOwnerUsecase,
        private readonly DestroyOwnerContract $destroyOwnerUsecase

    ) {}
    public function index()
    {
        $presenter = new ShowOwnersPaginatePresenter();
        $this->showOwnerUsecase->allWithPaginate($presenter , 10);
        return $presenter->handle();
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $presenter = new StoreOwnerPresenter();
        return $presenter->handle();
    }

    public function show(string $id)
    {
        $presenter = new ShowOwnerPresenter();
        $this->showOwnerUsecase->showById((int) $id ,$presenter);
        return $presenter->handle();
    }

    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
        $presenter = new UpdateOwnerPresenter();
        return $presenter->handle();
    }

    public function destroy(string $id)
    {
        $presenter = new DestroyOwnerPresenter();
        return $presenter->handle();
    }
}
