<?php

use App\Features\Owners\Presentation\API\Controllers\OwnerController;
use App\Shared\Presentation\API\Controllers\TokenController;
use Illuminate\Support\Facades\Route;




Route::name('api')->group(function () {
    Route::post('/tokens/create', [TokenController::class, 'authToken']);

    Route::resource('/owners', OwnerController::class);
});
