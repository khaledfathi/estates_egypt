<?php

declare(strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Presentation\Http\Presenters;

use App\Features\EstateMaintenanceExpenses\Application\Outputs\CreateEstateMaintenanceExpensesOutput;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Log;

final class CreateEstateMaintenanceExpensesPresenter implements CreateEstateMaintenanceExpensesOutput
{
    private Closure $response;
    public function __construct(
        private readonly int $estateId,
    ) { }
    public function onSuccess(EstateEntity $estateEntity): void
    {
        $this->response =  fn() => view('estates.maintenance-expenses::create', [
            'currentDate' =>Carbon::now()->toDateString(),
            'estate' => $estateEntity,
            'backUrl' => route('estates-maintenance-expenses.index', ['estate_id' => $this->estateId]),
        ]);
    }
    public function onEstateNotFound(): void
    {
        $this->response = fn() => view("estates.maintenance-expenses::create", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => back()->withErrors([
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
