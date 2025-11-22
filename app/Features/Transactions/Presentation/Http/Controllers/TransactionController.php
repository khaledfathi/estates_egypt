<?php

namespace App\Features\Transactions\Presentation\Http\Controllers;

use App\Features\Transactions\Application\Contracts\DestroyTransactionContract;
use App\Features\Transactions\Application\Contracts\EditTransactionContract;
use App\Features\Transactions\Application\Contracts\ShowTransactionContract;
use App\Features\Transactions\Application\Contracts\ShowTransactionsPaginationContract;
use App\Features\Transactions\Application\Contracts\StoreTransactionContract;
use App\Features\Transactions\Application\Contracts\UpdateTransactionContract;
use App\Features\Transactions\Presentation\Http\Presenters\DestroyTransactionPresenter;
use App\Features\Transactions\Presentation\Http\Presenters\EditTransactionPresenter;
use App\Features\Transactions\Presentation\Http\Presenters\ShowTransactionPresenter;
use App\Features\Transactions\Presentation\Http\Presenters\ShowTransactionsPaginationPresenter;
use App\Features\Transactions\Presentation\Http\Presenters\StoreTransactionPresenter;
use App\Features\Transactions\Presentation\Http\Presenters\UpdateTransactionPresenter;
use App\Features\Transactions\Presentation\Http\Requests\StoreTransactionRequest;
use App\Features\Transactions\Presentation\Http\Requests\UpdateTransactionRequest;
use App\Http\Controllers\Controller;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Domain\Enum\Transaction\TransactionDirection;
use App\Shared\Infrastructure\Utilities\CarbonDateUtility;
use Carbon\Carbon;
use Illuminate\Http\Request;

class  TransactionController extends Controller
{
   public function __construct(
      private readonly StoreTransactionContract $storeTransactionUsecase,
      private readonly ShowTransactionsPaginationContract $showTransactionsPaginationUsecase,
      private readonly ShowTransactionContract $showTransactionUsecase,
      private readonly EditTransactionContract $editTransactionUsecase,
      private readonly UpdateTransactionContract $updateTransactionUsecase,
      private readonly DestroyTransactionContract $destroyTransactionUsecase,
   ) {}
   public function index(Request $request)
   {
      //prepare 
      $date = $request['selected_date'] ?? Carbon::now()->toDateString();
      //action
      $presenter = new ShowTransactionsPaginationPresenter($date);
      $this->showTransactionsPaginationUsecase->execute($date, $presenter);
      return $presenter->handle();
   }
   public function show(string $transactionId)
   {
      $presenter = new ShowTransactionPresenter();
      $this->showTransactionUsecase->execute((int)$transactionId, $presenter);
      return $presenter->handle();
   }
   public function create()
   {
      return view('transactions::create', [
         'transactionDirections' => TransactionDirection::labels(),
         'defaultTransactionDirection' => TransactionDirection::WITHDRAW->value,
         'currentDate' => Carbon::now()->toDateString(),
      ]);
   }
   public function store(StoreTransactionRequest $request)
   {
      //prepare data 
      $transactionEntity = $this->formToTransactionEntity($request->all());
      //action 
      $presenter = new StoreTransactionPresenter();
      $this->storeTransactionUsecase->execute($transactionEntity, $presenter);
      return $presenter->handle();
   }
   public function edit(string $transactionId)
   {
      $presenter = new EditTransactionPresenter();
      $this->editTransactionUsecase->execute((int)$transactionId, $presenter);
      return $presenter->handle();
   }
   public function update(UpdateTransactionRequest $request)
   {
      //prepare 
      $transactionEntity= $this->formToTransactionEntity([...$request->all(), 'transaction_id'=>(int)$request->route('transaction')]);
      //aciton
      $presenter = new UpdateTransactionPresenter();
      $this->updateTransactionUsecase->execute($transactionEntity, $presenter);
      return $presenter->handle();
   }
   public function destroy(string $transactionId)
   {
      $presenter = new DestroyTransactionPresenter();
      $this->destroyTransactionUsecase->execute((int)$transactionId , $presenter);
      return $presenter->handle();
   }
   private function formToTransactionEntity(array $formArray): TransactionEntity
   {
      return new TransactionEntity(
         id: $formArray['transaction_id'] ?? null,
         date: CarbonDateUtility::from($formArray['date'] ?? null),
         direction: TransactionDirection::from($formArray['direction']),
         amount: abs((int) ($formArray['amount'] ?? null)),
         description: $formArray['description'] ?? null,
      );
   }
}
