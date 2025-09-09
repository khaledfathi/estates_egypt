<?php

namespace App\Features\Settings\Presentation\Http\Controllers; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class  SettingController extends Controller
{
   public function index()
   {
      $settings =[
         'settingPageCounts' => 20,
      ];
      return view("settings.index", $settings);
   }
}