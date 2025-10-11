<?php

declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Infrastructure\Providers;

use App\Features\UnitUtilityServices\Application\Contracts\DestroyUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Application\Contracts\ShowUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Application\Contracts\StoreUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Application\Contracts\UpdateUnitUtilityServiceContract;
use App\Features\UnitUtilityServices\Application\Usecases\DestroyUnitUtilityServiceUsecase;
use App\Features\UnitUtilityServices\Application\Usecases\ShowUnitUtilityServiceUsecase;
use App\Features\UnitUtilityServices\Application\Usecases\StroreUnitUtilityServicesUsecase;
use App\Features\UnitUtilityServices\Application\Usecases\UpdateUnitUtilityServiceUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class UnitUtilityServicesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Usecases 
        $this->app->bind(ShowUnitUtilityServiceContract::class, ShowUnitUtilityServiceUsecase::class);
        $this->app->bind(StoreUnitUtilityServiceContract::class , StroreUnitUtilityServicesUsecase::class);
        $this->app->bind(DestroyUnitUtilityServiceContract::class ,DestroyUnitUtilityServiceUsecase::class);
        $this->app->bind(UpdateUnitUtilityServiceContract::class , UpdateUnitUtilityServiceUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace('units.utility-services', base_path('app/Features/UnitUtilityServices/Presentation/Views'));
    }
}
