<?php
declare (strict_types= 1);

namespace App\Features\UnitOwnerships\Infrastructure\Providers;

use App\Features\UnitOwnerships\Application\Contracts\DestroyUnitOwnershipContract;
use App\Features\UnitOwnerships\Application\Contracts\StoreUnitOwnershipContract;
use App\Features\UnitOwnerships\Application\Usecases\DestroyUnitOwnershipUsecase;
use App\Features\UnitOwnerships\Application\Usecases\StoreUnitOwnershipUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class UnitOwnershipProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Usecases 
        $this->app->bind(StoreUnitOwnershipContract::class , StoreUnitOwnershipUsecase::class);
        $this->app->bind(DestroyUnitOwnershipContract::class , DestroyUnitOwnershipUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace( 'units.ownerships', base_path('app/Features/UnitOwnerships/Presentation/Views'));
    }
}
