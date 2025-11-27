<?php
declare (strict_types= 1);

namespace App\Features\AccountingManagement\Infrastructure\Providers;

use App\Features\AccountingManagement\Application\Contracts\ShowAllAccountingManagementContract;
use App\Features\AccountingManagement\Application\Usecases\ShowAllAccountingManagementUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AccountingManagementServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ShowAllAccountingManagementContract::class ,ShowAllAccountingManagementUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace( 'accounting-management', base_path('app/Features/AccountingManagement/Presentation/Views'));
    }
} 
