<?php

namespace App\Features\Estates\Presentation\Http\Controllers;

use App\Features\Estates\Application\Contracts\ShowEstateContract;
use App\Features\Estates\Application\Contracts\ShowEstatesPaginationContract;
use App\Features\Estates\Application\Contracts\StoreEstateContract;
use App\Features\Estates\Presentation\Http\Presenters\ShowEstaetsPaginatePresenter;
use App\Features\Estates\Presentation\Http\Presenters\ShowEstatePresenter;
use App\Features\Estates\Presentation\Http\Presenters\StoreEstatePresenter;
use App\Features\Estates\Presentation\Http\Requests\StoreEstateRequest;
use App\Http\Controllers\Controller;
use App\Shared\Domain\Entities\Estate\EstateEntity;

class EstateController extends Controller
{

   public function __construct(
      private readonly ShowEstateContract $showEstatetUsecase,
      private readonly ShowEstatesPaginationContract $showPaginateEstateUsecase,
      private readonly StoreEstateContract $storeEstateUsecase
   ) {}
   public function index()
   {
      $presenter = new ShowEstaetsPaginatePresenter();
      $this->showPaginateEstateUsecase->execute($presenter, 5);
      return $presenter->handle();
   }

   public function show(string $id)
   {
      $presenter = new ShowEstatePresenter();
      $this->showEstatetUsecase->execute((int)$id, $presenter);
      return $presenter->handle();
   }
   public function create()
   {
      return view('estates::create');
   }
   public function store(StoreEstateRequest $request)
   {
      //prepeare data
      $estateEntity = $this->formToEstateEntity([...$request->all()]);
      //action 
      $presenter = new StoreEstatePresenter();
      $this->storeEstateUsecase->execute($estateEntity, $presenter);
      return $presenter->handle();
   }
   public function edit(string $id)
   {
      return __CLASS__ . ":" . __FUNCTION__;
   }
   public function update(string $id)
   {
      return __CLASS__ . ":" . __FUNCTION__;
   }
   public function destroy(string $id)
   {
      return __CLASS__ . ":" . __FUNCTION__;
   }
   private function formToEstateEntity(array $formArray): EstateEntity
   {
      return new EstateEntity(
         name: $formArray['name'] ?? null,
         address: $formArray['address'] ?? null,
         floorCount: $formArray['floor_count'] ?? null,
         commercialUnitCount: $formArray['commercial_unit_count'] ?? null,
         residentialUnitCount: $formArray['residential_unit_count'] ?? null,
      );
   }
}
