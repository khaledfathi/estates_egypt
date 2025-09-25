<?php
namespace App\Features\Settings\Infrastructure\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
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
        View::addNamespace( 'settings', base_path('app/Features/Settings/Presentation/Views'));
    }
}
