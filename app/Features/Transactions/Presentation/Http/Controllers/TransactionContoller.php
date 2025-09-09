<?php

namespace App\Features\Transactions\Presentation\Http\Controllers; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class  TransactionContoller extends Controller
{
   public function index()
   {
      return view("transactions.index");
   }
}