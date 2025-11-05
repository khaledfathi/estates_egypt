<?php

namespace App\Features\Transactions\Presentation\Http\Controllers; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class  TransactionContoller extends Controller
{
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
      dd($request->all());
      return __CLASS__."::".__FUNCTION__;
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