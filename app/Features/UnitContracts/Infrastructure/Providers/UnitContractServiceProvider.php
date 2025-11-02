<?php
declare (strict_types= 1);

namespace App\Features\UnitContracts\Infrastructure\Providers;

use App\Features\UnitContracts\Application\Contracts\CreateUnitContractContract;
use App\Features\UnitContracts\Application\Contracts\DestroyUnitContractContract;
use App\Features\UnitContracts\Application\Contracts\EditUnitContractContract;
use App\Features\UnitContracts\Application\Contracts\ShowUnitContractContract;
use App\Features\UnitContracts\Application\Contracts\ShowUnitContractsPaginationContract;
use App\Features\UnitContracts\Application\Contracts\StoreUnitContractContract;
use App\Features\UnitContracts\Application\Contracts\UpdateUnitContractContract;
use App\Features\UnitContracts\Application\Usecases\CreateUnitContractContractUsecase;
use App\Features\UnitContracts\Application\Usecases\DestroyUnitContractUsecase;
use App\Features\UnitContracts\Application\Usecases\EditUnitContractUsecase;
use App\Features\UnitContracts\Application\Usecases\ShowUnitContractsPaginationUsecase;
use App\Features\UnitContracts\Application\Usecases\ShowUnitContractUsecase;
use App\Features\UnitContracts\Application\Usecases\StoreUnitContractUsecase;
use App\Features\UnitContracts\Application\Usecases\UpdateUnitContractUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class UnitContractServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Usecases 
        $this->app->bind(ShowUnitContractsPaginationContract::class, ShowUnitContractsPaginationUsecase::class);
        $this->app->bind(CreateUnitContractContract::class , CreateUnitContractContractUsecase::class);
        $this->app->bind(StoreUnitContractContract::class , StoreUnitContractUsecase::class);
        $this->app->bind(ShowUnitContractContract::class , ShowUnitContractUsecase::class);
        $this->app->bind(EditUnitContractContract::class , EditUnitContractUsecase::class);
        $this->app->bind(UpdateUnitContractContract::class, UpdateUnitContractUsecase::class);
        $this->app->bind(DestroyUnitContractContract::class, DestroyUnitContractUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace( 'unit-contracts', base_path('app/Features/UnitContracts/Presentation/Views'));
    }
}
