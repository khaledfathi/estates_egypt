<?php
declare (strict_types= 1);

namespace App\Features\MaintenancePayments\Infrastructure\Providers; 

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MaintenancePaymentServiceProvider extends ServiceProvider
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
        View::addNamespace( 'maintenance-payments', base_path('app/Features/MaintenancePayments/Presentation/Views'));
    }
} 
