<?php

declare(strict_types=1);

namespace App\Features\EstateUtilityServiceInvoices\Infrastructure\Providers;

use App\Features\EstateUtilityServiceInvoices\Application\Contracts\CreateEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Application\Contracts\DestroyEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Application\Contracts\DownloadEstateUtilityServiceInvoiceFileContract;
use App\Features\EstateUtilityServiceInvoices\Application\Contracts\EditEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Application\Contracts\StoreEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Application\Contracts\UpdateEstateUtilityServiceInvoiceContract;
use App\Features\EstateUtilityServiceInvoices\Application\Usecases\CreateEstateUtilityServiceInvoiceUsecase;
use App\Features\EstateUtilityServiceInvoices\Application\Usecases\DestroyEstateUtilityServiceInvoiceUsecase;
use App\Features\EstateUtilityServiceInvoices\Application\Usecases\DownloadEstateUtilityServiceInvoiceFileUsecase;
use App\Features\EstateUtilityServiceInvoices\Application\Usecases\EditEstateUtilityServiceInvoiceUsecase;
use App\Features\EstateUtilityServiceInvoices\Application\Usecases\StoreEstateUtilityServiceInvoiceUsecase;
use App\Features\EstateUtilityServiceInvoices\Application\Usecases\UpdateEstateUtilityServiceInvoiceUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class EstateUtilityServiceInvoiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //usecases
        $this->app->bind(CreateEstateUtilityServiceInvoiceContract::class, CreateEstateUtilityServiceInvoiceUsecase::class);
        $this->app->bind(StoreEstateUtilityServiceInvoiceContract::class, StoreEstateUtilityServiceInvoiceUsecase::class);
        $this->app->bind(DestroyEstateUtilityServiceInvoiceContract::class , DestroyEstateUtilityServiceInvoiceUsecase::class);
        $this->app->bind(DownloadEstateUtilityServiceInvoiceFileContract::class , DownloadEstateUtilityServiceInvoiceFileUsecase::class );
        $this->app->bind(EditEstateUtilityServiceInvoiceContract::class,  EditEstateUtilityServiceInvoiceUsecase::class);
        $this->app->bind(UpdateEstateUtilityServiceInvoiceContract::class,  UpdateEstateUtilityServiceInvoiceUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace('estates.utility-service-invoices', base_path('app/Features/EstateUtilityServiceInvoices/Presentation/Views'));
    }
}
