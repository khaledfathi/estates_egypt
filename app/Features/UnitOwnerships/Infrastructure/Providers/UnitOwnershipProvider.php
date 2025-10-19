<?php

declare(strict_types=1);

namespace App\Features\UnitOwnerships\Infrastructure\Providers;

use App\Features\UnitOwnerships\Application\Contracts\CreateUnitOwnershipContract;
use App\Features\UnitOwnerships\Application\Contracts\DestroyUnitOwnershipContract;
use App\Features\UnitOwnerships\Application\Contracts\StoreUnitOwnershipsByOwnerGoupsContract;
use App\Features\UnitOwnerships\Application\Contracts\StoreUnitOwnershipsByOwnersContract;
use App\Features\UnitOwnerships\Application\Usecases\CreateUnitOwnershipUsecase;
use App\Features\UnitOwnerships\Application\Usecases\DestroyUnitOwnershipUsecase;
use App\Features\UnitOwnerships\Application\Usecases\StoreUnitOwnershipsByOwnerGoupsUsecase;
use App\Features\UnitOwnerships\Application\Usecases\StoreUnitOwnershipsByOwnersUsecase;
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
        $this->app->bind(StoreUnitOwnershipsByOwnersContract::class, StoreUnitOwnershipsByOwnersUsecase::class);
        $this->app->bind(StoreUnitOwnershipsByOwnerGoupsContract::class, StoreUnitOwnershipsByOwnerGoupsUsecase::class);
        $this->app->bind(DestroyUnitOwnershipContract::class, DestroyUnitOwnershipUsecase::class);
        $this->app->bind(CreateUnitOwnershipContract::class, CreateUnitOwnershipUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace('units.ownerships', base_path('app/Features/UnitOwnerships/Presentation/Views'));
    }
}
