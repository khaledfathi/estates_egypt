<?php

declare(strict_types=1);

namespace App\Features\OwnerGroups\Infrastructure\Providers;

use App\Features\OwnerGroups\Application\Contracts\DestroyOwnerGroupContract;
use App\Features\OwnerGroups\Application\Contracts\ShowOwnerGroupContract;
use App\Features\OwnerGroups\Application\Contracts\StoreOwnerGroupContract;
use App\Features\OwnerGroups\Application\Usecases\DestroyOwnerGroupUsecase;
use App\Features\OwnerGroups\Application\Usecases\ShowOwnerGroupUsecase;
use App\Features\OwnerGroups\Application\Usecases\StoreOwnerGroupUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class OwnerGroupServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ShowOwnerGroupContract::class , ShowOwnerGroupUsecase::class);
        $this->app->bind(StoreOwnerGroupContract::class , StoreOwnerGroupUsecase::class);
        $this->app->bind(DestroyOwnerGroupContract::class , DestroyOwnerGroupUsecase::class);
    }
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace('owner-groups', base_path('app/Features/OwnerGroups/Presentation/Views'));
    }
}
