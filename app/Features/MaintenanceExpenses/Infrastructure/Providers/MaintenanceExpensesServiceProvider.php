<?php
declare (strict_types= 1);

namespace App\Features\MaintenanceExpenses\Infrastructure\Providers;

use App\Features\MaintenanceExpenses\Application\Contracts\ShowAllMaintenanceExpensesContract;
use App\Features\MaintenanceExpenses\Application\Usecases\ShowAllMaintenanceExpensesUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MaintenanceExpensesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ShowAllMaintenanceExpensesContract::class ,ShowAllMaintenanceExpensesUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace( 'maintenance-expenses', base_path('app/Features/MaintenanceExpenses/Presentation/Views/'));
    }
} 
