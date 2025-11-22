<?php

use App\Features\Accounting\Presentation\Http\Controllers\AccountingController;
use App\Features\EstateDocuments\Presentation\Http\Controllers\EstateDocumentController;
use App\Features\EstateMaintenanceExpenses\Presentation\Http\Controllers\EstateMaintenanceExpensesController;
use App\Features\Estates\Presentation\Http\Controllers\EstateController;
use App\Features\EstateUtilityServiceInvoices\Presentation\Http\Controllers\EstateUtilityServiceInvoiceController;
use App\Features\EstateUtilityServices\Presentation\Http\Controllers\EstateUtilityServicesController;
use App\Features\MaintenanceExpenses\Presentation\Http\Controllers\MaintenanceExpensesController;
use App\Features\OwnerGroups\Presentation\Http\Controllers\OwnerGroupController;
use App\Features\Owners\Presentation\Http\Controllers\OwnerController;
use App\Features\Queries\Presentation\Http\Controllers\QueryContoller;
use App\Features\Renters\Presentation\Http\Controllers\RenterController;
use App\Features\Settings\Presentation\Http\Controllers\SettingController;
use App\Features\Transactions\Presentation\Http\Controllers\TransactionController;
use App\Features\UnitContracts\Presentation\Http\Controllers\UnitContractController;
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
    Route::group(['prefix' => '/profile'], function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::resource('/owners', OwnerController::class);
    Route::resource('/owner-groups', OwnerGroupController::class);
    Route::delete('/owner-groups/{owner_group}/unlink-owner/{owner_in_group}', [OwnerGroupController::class, 'unlinkOwner'])->name('owner-groups.unlink');

    Route::resource('/renters', RenterController::class);
    Route::resource('/estates', EstateController::class);
    Route::resource('/estates.units', UnitController::class);
    Route::resource('/estates.units.utility-services', UnitUtilityServiceController::class);

    Route::resource('/estates.units.contracts', UnitContractController::class);

    Route::get('/estates/{estate}/documents/view-file/{file}', [EstateDocumentController::class, 'viewFile'])
        ->name('estates.documents.view-file');
    Route::get('/estates/{estate}/documents/download/{file}', [EstateDocumentController::class, 'download'])
        ->name('estates.documents.download');
    Route::resource('/estates.documents', EstateDocumentController::class);

    Route::resource('/estates.utility-services', EstateUtilityServicesController::class);

    Route::get('/estates/{estate}/utility-services/{utility_service}/invoices/{invoice}/view-file/{file}', [EstateUtilityServiceInvoiceController::class, 'viewFile'])
        ->name('estates.utility-services.invoices.view-file');
    Route::get('/estates/{estate}/utility-services/{utility_service}/invoices/{invoice}/download/{file}', [EstateUtilityServiceInvoiceController::class, 'download'])
        ->name('estates.utility-services.invoices.download');
    Route::resource('/estates.utility-services.invoices', EstateUtilityServiceInvoiceController::class);

    Route::resource('/estates.units.ownerships', UnitOwnershipController::class);

    Route::resource('/estates-maintenance-expenses',EstateMaintenanceExpensesController::class);

    Route::resource('/settings', SettingController::class)->only('index');

    Route::resource('/transactions', TransactionController::class);

    Route::get('/accounting', [AccountingController::class , 'index'])->name('accounting.index');
    Route::get('/maintenance-expenses', [MaintenanceExpensesController::class , 'index'])->name('maintenance-expenses.index');
});

/* FOR TEST  */
Route::get('/queries', [QueryContoller::class, 'index'])->name('queries.index');




require __DIR__ . '/auth.php';
