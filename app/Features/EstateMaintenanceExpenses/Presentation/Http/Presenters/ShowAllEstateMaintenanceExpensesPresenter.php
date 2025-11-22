<?php

declare(strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Presentation\Http\Presenters;

use App\Features\EstateMaintenanceExpenses\Application\Outputs\ShowAllEstateMaintenanceExpensesOutput;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class  ShowAllEstateMaintenanceExpensesPresenter implements ShowAllEstateMaintenanceExpensesOutput
{
    private Closure $response;
    public function onSucess(EstateEntity $estateEntity,  EntitiesWithPagination $entitiesWithPagination): void
    {
        $data = [
            'estate' => $estateEntity,
            'estateMaintenanceExpenses' => $entitiesWithPagination->entities,
            'pagination' => $entitiesWithPagination->pagination,
        ];
        $this->response = fn() => view('estates.maintenance-expenses::index', $data);
    }
    public function onEstaetNotFound(): void
    {
        $this->response = fn() => view("estates.maintenance-expenses::index", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => view("units::show", [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error,  'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }
    public function handle()
    {
        return ($this->response)();
    }
}
