<?php

use App\Features\Owners\Presentation\API\Controllers\OwnerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::resource('/owners', OwnerController::class);