<?php

declare(strict_types=1);

namespace App\Features\EstateMaintenanceExpenses\Presentation\Http\Presenters;

use App\Features\EstateMaintenanceExpenses\Application\Outputs\ShowAllEstateMaintenanceExpensesOutput;
use App\Shared\Domain\Entities\Estate\EstateEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Log;

final class  ShowAllEstateMaintenanceExpensesPresenter implements ShowAllEstateMaintenanceExpensesOutput
{
    private Closure $response;
    public function __construct(
        private readonly int $year
    ){
        $this->handleSession();
    }
    private function handleSession()
    {
        $currentPage = request()->fullUrl(); 
        session()->put(SessionKeys::ESTATE_MAINTENANCE_EXPENSE_CURRENT_INDEX_PAGE, $currentPage);
        session()->put(SessionKeys::ESTATE_MAINTENANCE_EXPENSE_EDIT_PREVIOUS_PAGE, $currentPage);
    }
    public function onSucess(EstateEntity $estateEntity,  EntitiesWithPagination $entitiesWithPagination): void
    {
        $pagination = $entitiesWithPagination->pagination->withQueryParameters(['selected_year'=>$this->year , 'estate_id'=>$estateEntity->id]);
        $data = [
            'estate' => $estateEntity,
            'estateMaintenanceExpenses' => $entitiesWithPagination->entities,
            'pagination' => $pagination,
            'selectedYear' => $this->year, 
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
