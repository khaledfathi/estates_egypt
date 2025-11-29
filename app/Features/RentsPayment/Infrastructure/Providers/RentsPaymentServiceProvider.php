<?php
namespace App\Features\RentsPayment\Infrastructure\Providers; 

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class RentsPaymentServiceProvider extends ServiceProvider
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
        View::addNamespace( 'rents-payment', base_path('app/Features/RentsPayment/Presentation/Views'));
    }
}
