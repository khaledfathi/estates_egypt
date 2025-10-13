<?php


return [
    App\Providers\AppServiceProvider::class,
    App\Shared\Infrastructure\Providers\SharedServiceProvider::class,
    App\Features\Dashboard\Infrastructure\Providers\DashboardServiceProvider::class,
    App\Features\Owners\Infrastructure\Providers\OwnerServiceProvider::class,
    App\Features\Renters\Infrastructure\Providers\RenterServiceProvider::class,
    App\Features\Estates\Infrastructure\Providers\EstateServiceProvider::class,
    App\Features\Units\Infrastructure\Providers\UnitServiceProvider::class,
    App\Features\Queries\Infrastructure\Providers\QueryServiceProvider::class,
    App\Features\Settings\Infrastructure\Providers\SettingServiceProvider::class,
    App\Features\Transactions\Infrastructure\Providers\TransactionServiceProvider::class,
    App\Features\EstateDocuments\Infrastructure\Providers\EstateDocumentServiceProvider::class,
    App\Features\EstateUtilityServices\Infrastructure\Providers\EstateUtilityServicesServiceProvider::class,
    App\Features\UnitUtilityServices\Infrastructure\Providers\UnitUtilityServicesServiceProvider::class,
    App\Features\UnitOwnerships\Infrastructure\Providers\UnitOwnershipProvider::class,
];
