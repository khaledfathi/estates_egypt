<?php
namespace App\Features\Renters\Infrastructure\Providers;

use App\Features\Renters\Application\Contracts\DestroyRenterContract;
use App\Features\Renters\Application\Contracts\ShowRenterContract;
use App\Features\Renters\Application\Contracts\StoreRenterContract;
use App\Features\Renters\Application\Contracts\UpdateRenterContract;
use App\Features\Renters\Application\Usecases\DestroyRenterUsecase;
use App\Features\Renters\Application\Usecases\ShowRenterUsecase;
use App\Features\Renters\Application\Usecases\StoreRenterUsecase;
use App\Features\Renters\Application\Usecases\UpdateRenterUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class RenterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StoreRenterContract::class , StoreRenterUsecase::class);
        $this->app->bind(ShowRenterContract::class , ShowRenterUsecase::class);
        $this->app->bind(DestroyRenterContract::class , DestroyRenterUsecase::class);
        $this->app->bind(UpdateRenterContract::class , UpdateRenterUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace( 'renters', base_path('app/Features/Renters/Presentation/Views'));
    }
}
