<?php
declare (strict_types= 1);

namespace App\Features\Units\Infrastructure\Providers;

use App\Features\Units\Application\Contracts\CreateUnitContract;
use App\Features\Units\Application\Contracts\DestroyUnitContract;
use App\Features\Units\Application\Contracts\EditUnitContract;
use App\Features\Units\Application\Contracts\ShowUnitsPaginationContract;
use App\Features\Units\Application\Contracts\ShowUnitContract;
use App\Features\Units\Application\Contracts\StoreUnitContract;
use App\Features\Units\Application\Contracts\UpdateUnitContract;
use App\Features\Units\Application\Usecases\CreateUnitUsecase;
use App\Features\Units\Application\Usecases\DestroyUnitUsecase as UsecasesDestroyUnitUsecase;
use App\Features\Units\Application\Usecases\EditUnitUsecase;
use App\Features\Units\Application\Usecases\ShowPaginateUnitUsecase;
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
        $this->app->bind(ShowUnitsPaginationContract::class , ShowPaginateUnitUsecase::class);
        $this->app->bind(CreateUnitContract::class , CreateUnitUsecase::class);
        $this->app->bind(StoreUnitContract::class , StoreUnitUsecase::class);
        $this->app->bind(UpdateUnitContract::class , UsecasesUpdateUnitUsecase::class);
        $this->app->bind(EditUnitContract::class , EditUnitUsecase::class);
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
