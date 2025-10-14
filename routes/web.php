<?php

use App\Features\EstateDocuments\Presentation\Http\Controllers\EstateDocumentController;
use App\Features\Estates\Presentation\Http\Controllers\EstateController;
use App\Features\EstateUtilityServices\Presentation\Http\Controllers\EstateUtilityServicesController;
use App\Features\OwnerGroups\Presentation\Http\Controllers\OwnerGroupController;
use App\Features\Owners\Presentation\Http\Controllers\OwnerController;
use App\Features\Queries\Presentation\Http\Controllers\QueryContoller;
use App\Features\Renters\Presentation\Http\Controllers\RenterController;
use App\Features\Settings\Presentation\Http\Controllers\SettingController;
use App\Features\Transactions\Presentation\Http\Controllers\TransactionContoller;
use App\Features\UnitOwnerships\Presentation\Http\Controllers\UnitOwnershipController;
use App\Features\Units\Presentation\Http\Controllers\UnitController;
use App\Features\UnitUtilityServices\Presentation\Http\Controllers\UnitUtilityServiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard::index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::group(['prefix'=>'/profile'], function (){
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::resource('/owners', OwnerController::class);
    Route::resource('/owner-groups', OwnerGroupController::class);
    Route::resource('/renters' , RenterController::class );
    Route::resource('/estates' , EstateController::class );
    Route::resource('/estates.units' , UnitController::class );
    Route::resource('/estates.units.utility-services' , UnitUtilityServiceController::class );

    Route::get('/estates/{estate}/documents/view-file/{file}', [EstateDocumentController::class, 'viewFile'])
        ->name('estates.documents.view-file');
    Route::get('/estates/{estate}/documents/download/{file}', [EstateDocumentController::class, 'download'])
        ->name('estates.documents.download'); 
    Route::resource('/estates.documents' , EstateDocumentController::class );

    Route::resource('/estates.utility-services' , EstateUtilityServicesController::class );
    Route::resource('/estates.units.ownerships' , UnitOwnershipController::class );

    Route::resource('/settings', SettingController::class)->only('index');

});

/* FOR TEST  */
Route::get('/queries' , [QueryContoller::class, 'index'])->name('queries.index');
Route::get('/transactions' , [TransactionContoller::class, 'index'])->name('transactions.index');




require __DIR__.'/auth.php';
