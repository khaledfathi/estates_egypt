<?php
declare (strict_types= 1);

namespace App\Features\Estates\Infrastructure\Providers;

use App\Features\Estates\Application\Contracts\ShowEstateContract;
use App\Features\Estates\Application\Contracts\ShowEstatesPaginationContract;
use App\Features\Estates\Application\Contracts\StoreEstateContract;
use App\Features\Estates\Application\Usecases\ShowEstateUsecase;
use App\Features\Estates\Application\Usecases\ShowPaginateEstateUsecase;
use App\Features\Estates\Application\Usecases\StoreEstateUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class EstateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ShowEstateContract::class , ShowEstateUsecase::class);
        $this->app->bind(ShowEstatesPaginationContract::class ,ShowPaginateEstateUsecase::class);
        $this->app->bind(StoreEstateContract::class,StoreEstateUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace( 'estates', base_path('app/Features/Estates/Presentation/Views'));
    }
}
