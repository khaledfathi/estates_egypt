<?php
declare (strict_types= 1);

namespace App\Features\Units\Infrastructure\Providers;

use App\Features\Units\Application\Contracts\DestroyUnitContract;
use App\Features\Units\Application\Contracts\ShowUnitContract;
use App\Features\Units\Application\Contracts\StoreUnitContract;
use App\Features\Units\Application\Contracts\UpdateUnitContract;
use App\Features\Units\Application\Usecases\DestroyUnitUsecase as UsecasesDestroyUnitUsecase;
use App\Features\Units\Application\Usecases\ShowUnitUsecase;
use App\Features\Units\Application\Usecases\StoreUnitUsecase;
use App\Features\Units\Application\Usecases\UpdateUnitUsecase as UsecasesUpdateUnitUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class UnitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Usecases 
        $this->app->bind(ShowUnitContract::class , ShowUnitUsecase::class);
        $this->app->bind(StoreUnitContract::class , StoreUnitUsecase::class);
        $this->app->bind(UpdateUnitContract::class , UsecasesUpdateUnitUsecase::class);
        $this->app->bind(DestroyUnitContract::class, UsecasesDestroyUnitUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace( 'units', base_path('app/Features/Units/Presentation/Views'));
    }
}
