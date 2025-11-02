<?php

declare(strict_types=1);

namespace App\Features\UnitContracts\Presentation\Http\Presenters;

use App\Features\UnitContracts\Application\Ouputs\ShowUnitContractsPaginationOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowUnitContractsPaginationPresenter implements ShowUnitContractsPaginationOutput
{

    private Closure $response;
    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $currentPage = url()->current() . '?page=' . request('page');
        session()->put(SessionKeys::UNIT_CONTRACT_CURRENT_INDEX_PAGE, $currentPage);
        session()->put(SessionKeys::UNIT_CONTRACT_EDIT_PREVIOUS_PAGE, $currentPage);
    }
    public function onSuccess(UnitEntity $unitEntity , EntitiesWithPagination $UnitContractEntitiesWithPagination):void
    {
        $data = [
            'estate' => $unitEntity->estate,
            'unit' => $unitEntity,
            'unitContracts'=> $UnitContractEntitiesWithPagination->entities,
            'pagination'=> $UnitContractEntitiesWithPagination->pagination,
        ];
        $this->response = fn()=> view('unit-contracts::index', $data);
    }
    public function onUnitNotFound():void
    {
        $this->response =fn()=> view("unit-contracts::index", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error):void
    {
        $this->response = fn() => view('unit-contracts::index', [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
        //log
        Log::channel(LogChannels::ERROR)->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
    }
    public function handle()
    {
        return ($this->response)(); 
    }
}
