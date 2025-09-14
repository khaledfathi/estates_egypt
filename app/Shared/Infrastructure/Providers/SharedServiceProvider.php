<?php
declare (strict_types= 1);

namespace App\Shared\Infrastructure\Providers;

use App\Shared\Domain\Repositories\OwnerRepository;
use App\Shared\Domain\Repositories\RenterRepositroy;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentOwnerRepository;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentRenterRepository;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
