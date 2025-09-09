<?php
declare(strict_types= 1);

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::addLocation(base_path('app/Shared/Presentation/Views'));
        View::addLocation(base_path('app/Features/Dashboard/Presentation/Views'));
        View::addLocation(base_path('app/Features/Estates/Presentation/Views'));
        View::addLocation(base_path('app/Features/Owners/Presentation/Views'));
        View::addLocation(base_path('app/Features/Queries/Presentation/Views'));
        View::addLocation(base_path('app/Features/Renters/Presentation/Views'));
        View::addLocation(base_path('app/Features/Settings/Presentation/Views'));
        View::addLocation(base_path('app/Features/Transactions/Presentation/Views'));
    }
}
