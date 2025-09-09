<?php
declare (strict_types= 1);

namespace App\Shared\Infrastructure\Providers;

use App\Shared\Domain\Repositories\OwnerRepository;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentOwnerRepository;
use Illuminate\Support\ServiceProvider;

class SharedServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(OwnerRepository::class ,EloquentOwnerRepository::class );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
