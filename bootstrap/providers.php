<?php


return [
    App\Providers\AppServiceProvider::class,
    App\Shared\Infrastructure\Providers\SharedServiceProvider::class,
    App\Features\Dashboard\Infrastructure\Providers\DashboardServiceProvider::class,
    App\Features\Owners\Infrastructure\Providers\OwnerServiceProvider::class,
    App\Features\Renters\Infrastructure\Providers\RenterServiceProvider::class,
];
