<?php

declare(strict_types=1);

namespace App\Features\EstateDocuments\Infrastructure\Providers;

use App\Features\EstateDocuments\Application\Contracts\DestroyEstateDocumentContract;
use App\Features\EstateDocuments\Application\Contracts\DownloadEstateDocumentFileContract;
use App\Features\EstateDocuments\Application\Contracts\ShowEstateDocumentContract;
use App\Features\EstateDocuments\Application\Contracts\StoreEstateDocumentContract;
use App\Features\EstateDocuments\Application\Contracts\UpdateEstateDocumentContract;
use App\Features\EstateDocuments\Application\Usecases\DestroyEstateDocumentUsecase;
use App\Features\EstateDocuments\Application\Usecases\DownloadEstateDocumentFileUsecase;
use App\Features\EstateDocuments\Application\Usecases\ShowEstateDocumentsUsecase;
use App\Features\EstateDocuments\Application\Usecases\StoreEstateDocumentUsecase;
use App\Features\EstateDocuments\Application\Usecases\UpdateEstateDocumentUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class EstateDocumentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ShowEstateDocumentContract::class, ShowEstateDocumentsUsecase::class);
        $this->app->bind(StoreEstateDocumentContract::class , StoreEstateDocumentUsecase::class);
        $this->app->bind(DestroyEstateDocumentContract::class , DestroyEstateDocumentUsecase::class);
        $this->app->bind(UpdateEstateDocumentContract::class , UpdateEstateDocumentUsecase::class);
        $this->app->bind(DownloadEstateDocumentFileContract::class , DownloadEstateDocumentFileUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace('estates.documents', base_path('app/Features/EstateDocuments/Presentation/Views'));
    }
}
