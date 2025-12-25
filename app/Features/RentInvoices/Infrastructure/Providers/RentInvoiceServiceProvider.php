<?php
namespace App\Features\RentInvoices\Infrastructure\Providers;

use App\Features\RentInvoices\Application\Contracts\CreateRentInvoiceContract;
use App\Features\RentInvoices\Application\Contracts\DestroyRentInvoiceContract;
use App\Features\RentInvoices\Application\Contracts\EditRentInvoiceContract;
use App\Features\RentInvoices\Application\Contracts\ShowAllRentInvoicesContract;
use App\Features\RentInvoices\Application\Contracts\ShowRentInvoiceContract;
use App\Features\RentInvoices\Application\Contracts\StoreRentInvoiceContract;
use App\Features\RentInvoices\Application\Contracts\UpdateRentInvoiceContract;
use App\Features\RentInvoices\Application\Usecase\CreateRentInvoiceUsecase;
use App\Features\RentInvoices\Application\Usecase\DestroyRentInvoiceUsecase;
use App\Features\RentInvoices\Application\Usecase\EditRentInvoiceUsecase;
use App\Features\RentInvoices\Application\Usecase\ShowAllRentInvoicesUsecase;
use App\Features\RentInvoices\Application\Usecase\ShowRentInvoiceUsecase;
use App\Features\RentInvoices\Application\Usecase\StoreRentInvoiceUsecase;
use App\Features\RentInvoices\Application\Usecase\UpdateRentInvoiceUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class RentInvoiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ShowAllRentInvoicesContract::class , ShowAllRentInvoicesUsecase::class);
        $this->app->bind(CreateRentInvoiceContract::class , CreateRentInvoiceUsecase::class);
        $this->app->bind(StoreRentInvoiceContract::class ,StoreRentInvoiceUsecase::class);
        $this->app->bind(ShowRentInvoiceContract::class, ShowRentInvoiceUsecase::class);
        $this->app->bind(EditRentInvoiceContract::class , EditRentInvoiceUsecase::class);
        $this->app->bind(DestroyRentInvoiceContract::class , DestroyRentInvoiceUsecase::class);
        $this->app->bind(UpdateRentInvoiceContract::class, UpdateRentInvoiceUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace( 'rent-invoices', base_path('app/Features/RentInvoices/Presentation/Views'));
    }
}
