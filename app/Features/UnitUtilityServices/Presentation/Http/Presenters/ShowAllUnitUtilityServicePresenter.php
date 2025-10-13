<?php

declare(strict_types=1);

namespace App\Features\UnitUtilityServices\Presentation\Http\Presenters;

use App\Features\UnitUtilityServices\Application\Outputs\ShowAllUnitUtilityServicesOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;
final class ShowAllUnitUtilityServicePresenter implements ShowAllUnitUtilityServicesOutput
{
    private Closure $response;
    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $currentPage = url()->current() ; 
        session()->put(SessionKeys::UNIT_UTILITY_SERVICE_CURRENT_INDEX_PAGE, $currentPage);
        session()->put(SessionKeys::UNIT_UTILITY_SERVICE_EDIT_PREVIOUS_PAGE, $currentPage);
    }
    /**
     * 
     * @inheritDoc
     */
    public function onSuccess(UnitEntity $unit, array $unitUtilityServicesEntities): void
    {
        $data = [
            'estate' => $unit->estate,
            'unit' => $unit,
            'unitUtilityServices' => $unitUtilityServicesEntities,
        ];
        $this->response = fn() => view('units.utility-services::index', $data);
    }
    public function onNotFound(): void
    {
        $this->response = fn() => view("units.utility-services::index", [
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
