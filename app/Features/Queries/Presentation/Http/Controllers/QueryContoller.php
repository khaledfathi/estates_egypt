<?php

namespace App\Features\Queries\Presentation\Http\Controllers; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class  QueryContoller extends Controller
{
   public function index()
   {
      return view("queries.index");
   }
}