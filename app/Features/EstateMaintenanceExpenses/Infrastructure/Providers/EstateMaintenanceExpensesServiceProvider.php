<?php

declare(strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Infrastructure\Providers;

use App\Features\EstateMaintenanceExpenses\Application\Contracts\CreateEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Contracts\DestroyEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Contracts\EditEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Contracts\ShowAllEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Contracts\ShowEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Contracts\StoreEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Contracts\UpdateEstateMaintenanceExpensesContract;
use App\Features\EstateMaintenanceExpenses\Application\Usecases\CreateEstateMaintenanceExpensesUsecase;
use App\Features\EstateMaintenanceExpenses\Application\Usecases\DestroyEstateMaintenanceExpensesUsecase;
use App\Features\EstateMaintenanceExpenses\Application\Usecases\EditEstateMaintenanceExpensesUsecase;
use App\Features\EstateMaintenanceExpenses\Application\Usecases\ShowAllEstateMaintenanceExpensesUsecase;
use App\Features\EstateMaintenanceExpenses\Application\Usecases\ShowEstateMaintenanceExpensesUsecase;
use App\Features\EstateMaintenanceExpenses\Application\Usecases\StoreEstateMaintenanceExpensesUsecase;
use App\Features\EstateMaintenanceExpenses\Application\Usecases\UpdateEstateMaintenanceExpensesUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class EstateMaintenanceExpensesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ShowAllEstateMaintenanceExpensesContract::class, ShowAllEstateMaintenanceExpensesUsecase::class);
        $this->app->bind(CreateEstateMaintenanceExpensesContract::class , CreateEstateMaintenanceExpensesUsecase::class);
        $this->app->bind(StoreEstateMaintenanceExpensesContract::class , StoreEstateMaintenanceExpensesUsecase::class);
        $this->app->bind(ShowEstateMaintenanceExpensesContract::class, ShowEstateMaintenanceExpensesUsecase::class);
        $this->app->bind(EditEstateMaintenanceExpensesContract::class , EditEstateMaintenanceExpensesUsecase::class);
        $this->app->bind(UpdateEstateMaintenanceExpensesContract::class , UpdateEstateMaintenanceExpensesUsecase::class);
        $this->app->bind(DestroyEstateMaintenanceExpensesContract::class , DestroyEstateMaintenanceExpensesUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace('estates.maintenance-expenses', base_path('app/Features/EstateMaintenanceExpenses/Presentation/Views'));
    }
}
