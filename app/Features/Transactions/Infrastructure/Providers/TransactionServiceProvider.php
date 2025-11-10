<?php
namespace App\Features\Transactions\Infrastructure\Providers;

use App\Features\Transactions\Application\Contracts\ShowTransactionsPaginationContract;
use App\Features\Transactions\Application\Contracts\StoreTransactionContract;
use App\Features\Transactions\Application\Usecases\ShowTransactionsPaginationUsecase;
use App\Features\Transactions\Application\Usecases\StoreTransactionUsecase;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TransactionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StoreTransactionContract::class ,StoreTransactionUsecase::class);
        $this->app->bind(ShowTransactionsPaginationContract::class , ShowTransactionsPaginationUsecase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace( 'transactions', base_path('app/Features/Transactions/Presentation/Views'));
    }
}
