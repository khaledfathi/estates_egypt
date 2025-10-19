<?php

declare(strict_types=1);

namespace App\Features\OwnerGroups\Infrastructure\Providers;

use App\Features\OwnerGroups\Application\Contracts\DestroyOwnerGroupContract;
use App\Features\OwnerGroups\Application\Contracts\EditOwnerGroupContract;
use App\Features\OwnerGroups\Application\Contracts\ShowOwnerGroupContract;
use App\Features\OwnerGroups\Application\Contracts\ShowOwnerGroupsPaginationContract;
use App\Features\OwnerGroups\Application\Contracts\StoreOwnerGroupContract;
use App\Features\OwnerGroups\Application\Contracts\UnlinkOwnerFromGroupContract;
use App\Features\OwnerGroups\Application\Contracts\UpdateOwnerGroupContrat;
use App\Features\OwnerGroups\Application\Usecases\DestroyOwnerGroupUsecase;
use App\Features\OwnerGroups\Application\Usecases\EditOwnerGroupUsecase;
use App\Features\OwnerGroups\Application\Usecases\ShowOwnerGroupUsecase;
use App\Features\OwnerGroups\Application\Usecases\ShowPaginateOwnerGroupUsecase;
use App\Features\OwnerGroups\Application\Usecases\StoreOwnerGroupUsecase;
use App\Features\OwnerGroups\Application\Usecases\UnlinkOwnerFromGroupUsecase;
use App\Features\OwnerGroups\Application\Usecases\UpdateOwnerGroupUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class OwnerGroupServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ShowOwnerGroupContract::class, ShowOwnerGroupUsecase::class);
        $this->app->bind(ShowOwnerGroupsPaginationContract::class, ShowPaginateOwnerGroupUsecase::class);
        $this->app->bind(StoreOwnerGroupContract::class, StoreOwnerGroupUsecase::class);
        $this->app->bind(DestroyOwnerGroupContract::class, DestroyOwnerGroupUsecase::class);
        $this->app->bind(UpdateOwnerGroupContrat::class, UpdateOwnerGroupUsecase::class);
        $this->app->bind(EditOwnerGroupContract::class, EditOwnerGroupUsecase::class);
        $this->app->bind(UnlinkOwnerFromGroupContract::class, UnlinkOwnerFromGroupUsecase::class);
    }
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace('owner-groups', base_path('app/Features/OwnerGroups/Presentation/Views'));
    }
}
