<?php

use App\Features\Estates\Presentation\Http\Controllers\EstateController;
use App\Features\Owners\Presentation\Http\Controllers\OwnerController;
use App\Features\Queries\Presentation\Http\Controllers\QueryContoller;
use App\Features\Renters\Presentation\Http\Controllers\RenterController;
use App\Features\Settings\Presentation\Http\Controllers\SettingController;
use App\Features\Transactions\Presentation\Http\Controllers\TransactionContoller;
use App\Http\Controllers\ProfileController;
use App\Models\UnitOwnership;
use Illuminate\Support\Facades\Route;

/*** WELCOME ***/
Route::get('/', function () {
    return view('welcome');
});
/*** END WELCOME ***/

/*** DASHBOARD ***/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
/*** END ASHBOARD ***/

Route::middleware('auth')->group(function () {
    /*** PROFILE ***/
    Route::group(['prefix'=>'/profile'], function (){
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    /*** END PROFILE ***/

    /*** Owners ***/
    Route::resource('/owners', OwnerController::class);
    /*** END Owners ***/

    /*** Renters ***/
    Route::resource('/renters' , RenterController::class );
    /*** / Renters ***/

    /*** Settings ***/
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    /*** / Settings ***/
});

/* FOR TEST  */
Route::get('/estates' , [EstateController::class, 'index'])->name('estates.index');
Route::get('/queries' , [QueryContoller::class, 'index'])->name('queries.index');
Route::get('/transactions' , [TransactionContoller::class, 'index'])->name('transactions.index');





require __DIR__.'/auth.php';
