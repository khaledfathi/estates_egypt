<?php
declare (strict_types= 1);

namespace App\Features\Queries\Infrastructure\Providers; 

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class QueryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace( 'queries', base_path('app/Features/Queries/Presentation/Views'));
    }
}
