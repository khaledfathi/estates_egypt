<?php
declare (strict_types= 1);

namespace App\Features\Accounting\Infrastructure\Providers; 

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AccountingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::addNamespace( 'accounting', base_path('app/Features/Accounting/Presentation/Views'));
    }
} 
