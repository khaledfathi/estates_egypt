<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServices\Infrastructure\Providers;

use App\Features\EstateUtilityServices\Application\Contracts\DestroyEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Contracts\ShowEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Contracts\StoreEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Usecases\ShowEstateUtilityServiceUsecase;
use App\Features\EstateUtilityServices\Application\Usecases\StoreEstateUtilityServiceUsecase;
use App\Features\EstateUtilityServices\Application\Usecases\UpdateEstateUtilityServiceUsecase;
use App\Features\EstateUtilityServices\Application\Contracts\UpdateEstateUtilityServiceContract;
use App\Features\EstateUtilityServices\Application\Usecases\DestroyEstateUtilityServiceUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class EstateUtilityServicesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ShowEstateUtilityServiceContract::class, ShowEstateUtilityServiceUsecase::class);
        $this->app->bind(StoreEstateUtilityServiceContract::class, StoreEstateUtilityServiceUsecase::class);
        $this->app->bind(DestroyEstateUtilityServiceContract::class , DestroyEstateUtilityServiceUsecase::class);
        $this->app->bind(UpdateEstateUtilityServiceContract::class , UpdateEstateUtilityServiceUsecase::class);
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace('estates.utility-services', base_path('app/Features/EstateUtilityServices/Presentation/Views'));
    }
}
