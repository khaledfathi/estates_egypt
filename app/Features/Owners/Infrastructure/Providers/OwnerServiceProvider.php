<?php
declare (strict_types= 1);

namespace App\Features\Owners\Infrastructure\Providers;

use App\Features\Owners\Application\Contracts\DestroyOwnerContract;
use App\Features\Owners\Application\Contracts\ShowOwnerContract;
use App\Features\Owners\Application\Contracts\StoreOwnerContract;
use App\Features\Owners\Application\Contracts\UpdateOwnerContract;
use App\Features\Owners\Application\Usecases\DestroyOwnerUsecase;
use App\Features\Owners\Application\Usecases\ShowOwnerUsecase;
use App\Features\Owners\Application\Usecases\StoreOwnerUsecase;
use App\Features\Owners\Application\Usecases\UpdateOwnerUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class OwnerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Usecases 
        $this->app->bind(StoreOwnerContract::class , StoreOwnerUsecase::class);
        $this->app->bind(ShowOwnerContract::class , ShowOwnerUsecase::class);
        $this->app->bind(UpdateOwnerContract::class, UpdateOwnerUsecase::class);
        $this->app->bind(DestroyOwnerContract::class , DestroyOwnerUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace( 'owners', base_path('app/Features/Owners/Presentation/Views'));
    }
}
