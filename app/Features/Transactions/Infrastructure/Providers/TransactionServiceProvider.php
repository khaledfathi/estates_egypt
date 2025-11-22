<?php

namespace App\Features\Transactions\Infrastructure\Providers;

use App\Features\Transactions\Application\Contracts\DestroyTransactionContract;
use App\Features\Transactions\Application\Contracts\EditTransactionContract;
use App\Features\Transactions\Application\Contracts\ShowTransactionContract;
use App\Features\Transactions\Application\Contracts\ShowTransactionsPaginationContract;
use App\Features\Transactions\Application\Contracts\StoreTransactionContract;
use App\Features\Transactions\Application\Contracts\UpdateTransactionContract;
use App\Features\Transactions\Application\Usecases\DestroyTransactionUsecase;
use App\Features\Transactions\Application\Usecases\EditTransactionUsecase;
use App\Features\Transactions\Application\Usecases\ShowTransactionsPaginationUsecase;
use App\Features\Transactions\Application\Usecases\ShowTransactionUsecase;
use App\Features\Transactions\Application\Usecases\StoreTransactionUsecase;
use App\Features\Transactions\Application\Usecases\UpdateTransactionUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TransactionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StoreTransactionContract::class, StoreTransactionUsecase::class);
        $this->app->bind(ShowTransactionsPaginationContract::class, ShowTransactionsPaginationUsecase::class);
        $this->app->bind(ShowTransactionContract::class, ShowTransactionUsecase::class);
        $this->app->bind(EditTransactionContract::class, EditTransactionUsecase::class);
        $this->app->bind(UpdateTransactionContract::class, UpdateTransactionUsecase::class);
        $this->app->bind(DestroyTransactionContract::class, DestroyTransactionUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace('transactions', base_path('app/Features/Transactions/Presentation/Views'));
    }
}
