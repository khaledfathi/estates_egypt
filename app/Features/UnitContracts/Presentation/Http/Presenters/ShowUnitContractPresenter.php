<?php

declare(strict_types=1);

namespace App\Features\UnitContracts\Presentation\Http\Presenters;

use App\Features\UnitContracts\Application\Ouputs\ShowUnitContractOutput;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowUnitContractPresenter implements ShowUnitContractOutput
{
    private Closure $response;
    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $previousPage = SessionKeys::UNIT_CONTRACT_EDIT_PREVIOUS_PAGE;
        session()->put($previousPage, url()->current());
    }
    public function onSuccess(UnitContractEntity $unitContractEntity): void
    {
        $data = [
            'estate' => $unitContractEntity->unit->estate,
            'unit' => $unitContractEntity->unit,
            'renter' => $unitContractEntity->renter,
            'unitContract' => $unitContractEntity,
        ];
        $this->response = fn() => view('unit-contracts::show', $data);
    }
    public function onNotFound(): void
    {
        $this->response = fn() => view("unit-contracts::show", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => view("unit-contracts::show", [
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
