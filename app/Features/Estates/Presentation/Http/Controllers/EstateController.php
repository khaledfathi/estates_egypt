<?php

namespace App\Features\Estates\Presentation\Http\Controllers; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstateController extends Controller
{
   public function index (){
    return view("estates.index");
   } 
}
