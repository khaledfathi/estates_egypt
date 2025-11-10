<?php

namespace App\Features\Transactions\Presentation\Http\Controllers;

use App\Features\Transactions\Application\Contracts\ShowTransactionsPaginationContract;
use App\Features\Transactions\Application\Contracts\StoreTransactionContract;
use App\Features\Transactions\Presentation\Http\Presenters\ShowTransactionsPaginationPresenter;
use App\Features\Transactions\Presentation\Http\Presenters\StoreTransactionPresenter;
use App\Features\Transactions\Presentation\Http\Requests\StoreTransactionRequest;
use App\Http\Controllers\Controller;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Domain\Enum\Transaction\TransactionDirection;
use App\Shared\Infrastructure\Utilities\CarbonDateUtility;
use Carbon\Carbon;

class  TransactionController extends Controller
{
   public function __construct(
      private readonly StoreTransactionContract $storeTransactionUsecase,
      private readonly ShowTransactionsPaginationContract $showTransactionsPaginationUsecase,
   ) {}
   public function index()
   {
      $presenter = new ShowTransactionsPaginationPresenter() ;
      $this->showTransactionsPaginationUsecase->execute($presenter);
      return $presenter->handle();
   }
   public function show()
   {
      return __CLASS__ . "::" . __FUNCTION__;
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
   public function edit()
   {
      return __CLASS__ . "::" . __FUNCTION__;
   }
   public function update()
   {
      return __CLASS__ . "::" . __FUNCTION__;
   }
   public function destroy()
   {
      return __CLASS__ . "::" . __FUNCTION__;
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
