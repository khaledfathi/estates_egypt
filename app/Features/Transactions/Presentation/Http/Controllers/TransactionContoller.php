<?php

namespace App\Features\Transactions\Presentation\Http\Controllers;

use App\Features\Transactions\Application\Contracts\StoreTransactionContract;
use App\Features\Transactions\Presentation\Http\Presenters\StoreTransactionPresenter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class  TransactionContoller extends Controller
{
   public function __construct(
      private readonly StoreTransactionContract $storeTransactionContract,
   ){ }
   public function index()
   {
      return view("transactions::index");
   }
   public function show(){
      return __CLASS__."::".__FUNCTION__;
   }
   public function create(){
      return __CLASS__."::".__FUNCTION__;
   }
   public function store(Request $request){
      //prepare data 
      $transactionEntity= null;
      //action 
      $presenter = new StoreTransactionPresenter();
      // $this->storeTransactionContract->execute();
      return $presenter->handle();
   }
   public function edit(){
      return __CLASS__."::".__FUNCTION__;
   }
   public function update(){
      return __CLASS__."::".__FUNCTION__;
   }
   public function destroy(){
      return __CLASS__."::".__FUNCTION__;
   }
}