<?php
declare (strict_types= 1);

namespace App\Shared\Infrastructure\Providers;

use App\Models\Estate;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\OwnerRepository;
use App\Shared\Domain\Repositories\RenterRepositroy;
use App\Shared\Domain\Repositories\UnitRepository;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentEstateRepository;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentOwnerRepository;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentRenterRepository;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentUnitRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SharedServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(OwnerRepository::class ,EloquentOwnerRepository::class );
        $this->app->bind(RenterRepositroy::class , EloquentRenterRepository::class);
        $this->app->bind(EstateRepositroy::class, EloquentEstateRepository::class);
        $this->app->bind(UnitRepository::class , EloquentUnitRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace( 'shared', base_path('app/Shared/Presentation/Views'));
    }
}
