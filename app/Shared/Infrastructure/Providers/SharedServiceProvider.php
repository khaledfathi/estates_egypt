<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Providers;

use App\Shared\Application\Contracts\Storage\Storage;
use App\Shared\Application\Contracts\Storage\StorageDir;
use App\Shared\Application\Utility\UtilityStorageDir;
use App\Shared\Domain\Repositories\EstateDocumentRepository;
use App\Shared\Domain\Repositories\EstateRepositroy;
use App\Shared\Domain\Repositories\EstateUtilityServiceRepository;
use App\Shared\Domain\Repositories\OwnerRepository;
use App\Shared\Domain\Repositories\RenterRepositroy;
use App\Shared\Domain\Repositories\UnitOwnershipRepository;
use App\Shared\Domain\Repositories\UnitRepository;
use App\Shared\Domain\Repositories\UnitUtilityServiceRepository;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentEstateDocumentRepository;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentEstateRepository;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentEstateUtilityServiceRepository;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentOwnerRepository;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentRenterRepository;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentUnitOwnershipRepository;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentUnitRepository;
use App\Shared\Infrastructure\Repositories\Eloquent\EloquentUnitUtilityServiceRepository;
use App\Shared\Infrastructure\Storage\LaravelStorage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SharedServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //repositories services  
        $this->app->bind(OwnerRepository::class, EloquentOwnerRepository::class);
        $this->app->bind(RenterRepositroy::class, EloquentRenterRepository::class);
        $this->app->bind(EstateRepositroy::class, EloquentEstateRepository::class);
        $this->app->bind(UnitRepository::class, EloquentUnitRepository::class);
        $this->app->bind(EstateDocumentRepository::class, EloquentEstateDocumentRepository::class);
        $this->app->bind(EstateUtilityServiceRepository::class, EloquentEstateUtilityServiceRepository::class);
        $this->app->bind(UnitUtilityServiceRepository::class , EloquentUnitUtilityServiceRepository::class);
        $this->app->bind(UnitOwnershipRepository::class , EloquentUnitOwnershipRepository::class);

        // framework services 
        $this->app->bind(Storage::class, LaravelStorage::class);

        //utility services  
        $this->app->bind(StorageDir::class, UtilityStorageDir::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace('shared', base_path('app/Shared/Presentation/Views'));
    }
}
