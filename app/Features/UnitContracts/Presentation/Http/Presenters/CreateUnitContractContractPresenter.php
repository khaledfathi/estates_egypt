<?php

declare(strict_types=1);

namespace App\Features\UnitContracts\Presentation\Http\Presenters;

use App\Features\UnitContracts\Application\Ouputs\CreateUnitContractContractOutput;
use App\Shared\Domain\Entities\Unit\UnitEntity;
use App\Shared\Domain\Enum\Unit\UnitContractType;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Log;

final class CreateUnitContractContractPresenter implements CreateUnitContractContractOutput
{
    private Closure $response;
    /**
     * @inheritDoc
     */
    public function onSuccess(UnitEntity $unitEntity, array $renterEntities): void
    {
        $data = [
            'unit' => $unitEntity,
            'estate' => $unitEntity->estate,
            'renters' => $renterEntities,
            'unitContractTypes' => UnitContractType::labels(),
            'currentDateValue' => Carbon::now()->toDateString(),
        ];
        $this->response = fn() => view('unit-contracts::create', $data);
    }
    public function onUnitNotFound(): void
    {
        $this->response = fn() => view('unit-contracts::create', [
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
