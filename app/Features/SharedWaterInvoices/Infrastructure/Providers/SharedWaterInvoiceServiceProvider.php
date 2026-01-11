<?php

namespace App\Features\SharedWaterInvoices\Infrastructure\Providers;

use App\Features\SharedWaterInvoices\Application\Contracts\EditSharedWaterInvoiceContract;
use App\Features\SharedWaterInvoices\Application\Contracts\ShowAllSharedWaterInvoiceContract;
use App\Features\SharedWaterInvoices\Application\Contracts\UpdateSharedWaterInvoiceContract;
use App\Features\SharedWaterInvoices\Application\Usecases\EditSharedWaterInvoiceUsecase;
use App\Features\SharedWaterInvoices\Application\Usecases\ShowAllSharedWaterInvoiceUsecase;
use App\Features\SharedWaterInvoices\Application\Usecases\UpdateSharedWaterInvoiceUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SharedWaterInvoiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ShowAllSharedWaterInvoiceContract::class, ShowAllSharedWaterInvoiceUsecase::class);
        $this->app->bind(EditSharedWaterInvoiceContract::class, EditSharedWaterInvoiceUsecase::class);
        $this->app->bind(UpdateSharedWaterInvoiceContract::class , UpdateSharedWaterInvoiceUsecase::class);
    }
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace('shared-water-invoices', base_path('app/Features/SharedWaterInvoices/Presentation/Views'));
    }
}
