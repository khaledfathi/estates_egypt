<?php
declare (strict_types= 1);
namespace App\Features\Renters\Presentation\Http\Controllers;

use App\Features\Renters\Application\Contracts\DestroyRenterContract;
use App\Features\Renters\Application\Contracts\EditRenterContract;
use App\Features\Renters\Application\Contracts\ShowRentersPaginationContract;
use App\Features\Renters\Application\Contracts\ShowRenterContract;
use App\Features\Renters\Application\Contracts\StoreRenterContract;
use App\Features\Renters\Application\Contracts\UpdateRenterContract;
use App\Features\Renters\Presentation\Http\Presenters\DestroyRenterPresenter;
use App\Features\Renters\Presentation\Http\Presenters\EditRenterPresenter;
use App\Features\Renters\Presentation\Http\Presenters\ShowRenterPaginatePresenter;
use App\Features\Renters\Presentation\Http\Presenters\ShowRenterPresenter;
use App\Features\Renters\Presentation\Http\Presenters\StoreRenterPresenter;
use App\Features\Renters\Presentation\Http\Presenters\UpdateRenterPresenter;
use App\Features\Renters\Presentation\Http\Requests\StoreRenterRequest;
use App\Features\Renters\Presentation\Http\Requests\UpdateRenterRequest;
use App\Http\Controllers\Controller;
use App\Shared\Domain\Entities\Renter\RenterEntity;
use App\Shared\Domain\Entities\Renter\RenterPhoneEntity;
use App\Shared\Domain\Enum\Renter\RenterIdentityType;

class RenterController extends Controller
{
   public function __construct(
      private readonly StoreRenterContract $storeRenterUsecase,
      private readonly ShowRenterContract $showRenterUsecase,
      private readonly ShowRentersPaginationContract $ShowRentersPaginationContract,
      private readonly DestroyRenterContract $destroyRenterUsecase,
      private readonly EditRenterContract $editRenterUsecase,
      private readonly UpdateRenterContract $updateRenterUsecase
   ) {
   }
   public function index()
   {
      $presenter = new ShowRenterPaginatePresenter();
      $this->ShowRentersPaginationContract->execute($presenter, 5);
      return $presenter->handel();
   }
   public function show(string $id)
   {
      $presenter = new ShowRenterPresenter();
      $this->showRenterUsecase->execute((int)$id ,$presenter);
      return $presenter->handle(); 
   }
   public function create()
   {
      $renterIdentityTypes = RenterIdentityType::labels();
      return view('renters::create', ['renterIdentityTypes' => $renterIdentityTypes]);
   }
   public function store(StoreRenterRequest $request)
   {
      //prepeare data
      $renterEntity = $this->formToOwnerEntity($request->all());
      //action
      $presenter = new StoreRenterPresenter();
      $this->storeRenterUsecase->execute($renterEntity, $presenter);
      return $presenter->handle();
   }
   public function edit(string $id)
   {
      $presenter = new EditRenterPresenter();
      $this->editRenterUsecase->execute((int) $id , $presenter);
      return $presenter->handle();
   }
   public function update(UpdateRenterRequest $request , int $id)
   {
      //prepeare data
      $renterEntity = $this->formToOwnerEntity([...$request->all(), 'id' => (int) $id]);
      //action
      $presenter = new UpdateRenterPresenter();
      $this->updateRenterUsecase->execute($renterEntity , $presenter);
      return $presenter->handle();
   }
   public function destroy(string $id)
   {
      $presenter = new DestroyRenterPresenter();
      $this->destroyRenterUsecase->execute((int)$id, $presenter);
      return $presenter->handle();
   }
   private function formToOwnerEntity(array $formArray): RenterEntity
   {
      //
      $renterPhone = [];
      if (isset($formArray["phones"])) {
         foreach ($formArray["phones"] as $phone) {
            $renterPhone[] = new RenterPhoneEntity(phone: $phone);
         }
      }
      //return owner entity with phones if exist
      return new RenterEntity(
         $formArray['id'] ?? null,
         $formArray['name'] ?? null,
         RenterIdentityType::from($formArray['identity_type']),
         $formArray['identity_number'] ?? null,
         $renterPhone,
         $formArray['notes'] ?? null,
      );
   }
}
