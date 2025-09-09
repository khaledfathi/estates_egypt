<?php

namespace App\Features\Renters\Presentation\Http\Controllers; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RenterController extends Controller
{
   public function index (){
    return view("renters.index");
   } 
}
